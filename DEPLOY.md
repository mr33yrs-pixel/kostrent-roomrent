# Deployment Guide — JaiPremiumKost (Hostinger Shared Hosting via GitHub)

## Prerequisites

- Hostinger **Business** or **Premium** hosting plan (PHP 8.2+)
- MySQL database
- SSH access enabled (Business plan)
- GitHub repository with your code pushed
- Domain pointed to Hostinger nameservers

---

## Step 1: Build Production Assets Locally

Before pushing to GitHub, build the frontend assets:

```bash
npm run build
git add public/build -f
git commit -m "Add production build assets"
git push origin main
```

> **Note:** `public/build` is in `.gitignore` by default. Use `git add -f` to force-add it, or remove it from `.gitignore` if you prefer.

## Step 2: Connect GitHub to Hostinger

1. Go to Hostinger hPanel → **Advanced** → **Git**
2. Click **Create a new repository**
3. Enter your GitHub repo URL: `https://github.com/yourusername/room-rental-app.git`
4. Set the **Branch** to `main`
5. Set the **Repository directory** to: `/home/u123456789/jaikost`
6. Click **Create**

Hostinger will clone the repo into `/home/u123456789/jaikost/`.

## Step 3: Set Up Public Directory

Hostinger serves from `public_html/`. You need to point it to the Laravel `public/` folder.

**Option A — Symlink (recommended):**
```bash
# SSH into your hosting
cd /home/u123456789

# Backup and remove the default public_html
mv public_html public_html_backup

# Symlink public_html to Laravel's public directory
ln -s /home/u123456789/jaikost/public /home/u123456789/public_html
```

**Option B — Modify index.php:**
Copy `public/` contents into `public_html/`, then edit `public_html/index.php`:
```php
require __DIR__.'/../jaikost/vendor/autoload.php';
$app = require_once __DIR__.'/../jaikost/bootstrap/app.php';
```

## Step 4: Install Composer Dependencies (SSH)

```bash
cd /home/u123456789/jaikost
composer install --no-dev --optimize-autoloader
```

## Step 5: Create MySQL Database

1. Go to hPanel → **Databases** → **MySQL Databases**
2. Create a new database and user
3. Note: database name, username, password, host (usually `localhost`)

## Step 6: Configure `.env`

```bash
cd /home/u123456789/jaikost
cp .env.example .env
nano .env
```

Set these values:
```env
APP_NAME=JaiPremiumKost
APP_ENV=production
APP_DEBUG=false
APP_TIMEZONE=Asia/Jakarta
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123456789_jaikost
DB_USERNAME=u123456789_jaikost
DB_PASSWORD=your_secure_password

SESSION_DRIVER=file
SESSION_ENCRYPT=true
QUEUE_CONNECTION=database
CACHE_STORE=file
FILESYSTEM_DISK=public
LOG_LEVEL=warning
BCRYPT_ROUNDS=12

WHATSAPP_NUMBER=6281234567890
CONTACT_EMAIL=info@jaipremiumkost.com
ADMIN_EMAILS=your-admin@email.com
```

## Step 7: Run Setup Commands (SSH)

```bash
cd /home/u123456789/jaikost

php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

## Step 8: Create Admin User

```bash
php artisan tinker
```
```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'your-admin@email.com',
    'password' => bcrypt('your-secure-password'),
]);
```

> The email **must match** the `ADMIN_EMAILS` in `.env`.

## Step 9: Set Up Cron Jobs

Go to hPanel → **Advanced** → **Cron Jobs**:

```bash
# Laravel Scheduler (every minute)
* * * * * cd /home/u123456789/jaikost && php artisan schedule:run >> /dev/null 2>&1

# Queue Worker (every minute)
* * * * * cd /home/u123456789/jaikost && php artisan queue:work --stop-when-empty >> /dev/null 2>&1
```

## Step 10: Enable SSL

1. hPanel → **Security** → **SSL** → Enable free SSL
2. HTTPS redirect is already handled by `.htaccess`

## Step 11: PHP Configuration

Go to hPanel → **Advanced** → **PHP Configuration**:

| Setting | Value |
|---------|-------|
| PHP version | 8.2+ |
| `upload_max_filesize` | 10M |
| `post_max_size` | 12M |
| `max_execution_time` | 120 |
| `memory_limit` | 256M |

---

## Deploying Updates via GitHub

After pushing changes to GitHub:

### Auto-deploy (Webhook)
1. In hPanel → **Advanced** → **Git**, copy the **Webhook URL**
2. In GitHub → repo **Settings** → **Webhooks** → **Add webhook**
3. Paste the Webhook URL, set Content type to `application/json`
4. Select **Just the push event** → **Add webhook**

Now every `git push` to `main` automatically pulls changes on Hostinger.

### Manual deploy
In hPanel → **Advanced** → **Git** → click **Pull** to pull latest changes.

### After every deploy (SSH)
```bash
cd /home/u123456789/jaikost

composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

> **Tip:** You can create a `deploy.sh` script with these commands and run it after each pull.

---

## Troubleshooting

| Issue | Solution |
|-------|----------|
| 500 error | Check `storage/logs/laravel.log` |
| Storage images not loading | Run `php artisan storage:link` or fix symlink |
| Queued jobs not processing | Verify cron jobs in hPanel |
| Admin login fails | Ensure email matches `ADMIN_EMAILS` in `.env` |
| CSS/JS not loading | Run `npm run build` locally, commit, push, re-deploy |
| Git pull fails | Check SSH keys or repo permissions |
