<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin MRPZ2',
            'email' => 'admin@mrpz2.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $this->command->info('Admin user created: admin@mrpz2.com / password');

        // Run other seeders
        $this->call([
            ZoneSeeder::class,
            HouseholdSeeder::class,
            MemberSeeder::class,
        ]);
    }
}