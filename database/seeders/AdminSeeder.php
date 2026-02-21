<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Seed the admin user with a securely generated random password.
     * Password is saved to admin_password.txt and displayed in terminal.
     */
    public function run(): void
    {
        $password = Str::random(16);

        User::updateOrCreate(
            ['email' => 'mr33yrs@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make($password),
            ]
        );

        // Save password to file so it's not lost
        $filePath = base_path('admin_password.txt');
        $content = "=== JaiPremiumKost Admin Credentials ===\n";
        $content .= "Generated: " . now()->format('Y-m-d H:i:s') . "\n";
        $content .= "Email: mr33yrs@gmail.com\n";
        $content .= "Password: {$password}\n";
        $content .= "========================================\n";
        $content .= "DELETE THIS FILE AFTER NOTING THE PASSWORD!\n";
        file_put_contents($filePath, $content);

        $this->command->warn('⚠️  Admin user created with a NEW random password.');
        $this->command->info("   Email:    mr33yrs@gmail.com");
        $this->command->info("   Password: {$password}");
        $this->command->info("   Also saved to: admin_password.txt");
        $this->command->warn('⚠️  Delete admin_password.txt after noting the password!');
    }
}

