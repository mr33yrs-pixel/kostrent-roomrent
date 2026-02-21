# JaiPremiumKost - Room Rental Application

A modern room rental / boarding house (kost) web application built with Laravel 11, FilamentPHP v3, and Tailwind CSS.

## Features

- 🏠 **Public Website**: Browse rooms, view details, and contact via WhatsApp
- 🔐 **Admin Panel**: Manage rooms via FilamentPHP at `/admin`
- 🌐 **Bilingual**: English/Indonesian language switcher
- 📱 **Responsive**: Mobile-friendly design with hamburger menu
- 📊 **Analytics Ready**: Google Analytics integration

## Tech Stack

- **Framework**: Laravel 11
- **Admin Panel**: FilamentPHP v3
- **Styling**: Tailwind CSS 3.4
- **Build Tool**: Vite
- **Database**: SQLite (development) / MySQL (production)

## Installation

```bash
# Clone the repository
git clone <your-repo-url>
cd room-rental-app

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed the database (creates admin user + 4 default rooms)
php artisan db:seed

# Build assets
npm run build

# Start development server
php artisan serve
```

## Admin Setup

After running migrations, create an admin user via tinker:

```bash
php artisan tinker
>>> \App\Models\User::create(['name'=>'Admin','email'=>'your@email.com','password'=>bcrypt('your-password')]);
```

Then add the same email to `ADMIN_EMAILS` in your `.env` file.
Access the admin panel at: `http://localhost:8000/admin`

## Environment Variables

Update these in your `.env` file:

| Variable | Description |
|----------|-------------|
| `WHATSAPP_NUMBER` | WhatsApp number for booking (with country code, no +) |
| `GOOGLE_MAPS_EMBED_URL` | Google Maps embed iframe URL |
| `GOOGLE_ANALYTICS_ID` | Google Analytics 4 Measurement ID |
| `SOCIAL_MEDIA_HANDLE` | Instagram/social media handle |
| `CONTACT_EMAIL` | Contact email address |

## Project Structure

```
app/
├── Filament/Resources/    # Admin panel resources
├── Http/Middleware/       # SetLocale middleware
├── Models/               # Room, User models

resources/views/
├── components/layouts/   # Main app layout
├── home.blade.php       # Homepage
├── rooms.blade.php      # Rooms listing
├── room-detail.blade.php # Individual room page
├── contact.blade.php    # Contact page

lang/
├── en/messages.php      # English translations
├── id/messages.php      # Indonesian translations

database/seeders/
├── RoomSeeder.php       # Default 4 rooms
```

## Room Types

- **Premium**: 2 rooms (Premium 1, Premium 2) - IDR 2,500,000/month
- **Standard**: 2 rooms (Standard 1, Standard 2) - IDR 1,500,000/month

Default facilities: Motorcycle Parking, High-Speed WiFi, Shared Kitchen, Private Bathroom

## Production Deployment

1. Set `APP_DEBUG=false` in `.env`
2. Set `APP_ENV=production`
3. Update `APP_URL` to your domain
4. Configure your WhatsApp number and Google Maps URL
5. Run `npm run build` for production assets
6. Update `public/sitemap.xml` URLs to match your domain

## License

MIT License
