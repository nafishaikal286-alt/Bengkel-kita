<?php

namespace Database\Seeders;

use App\Models\HeroSetting;
use App\Models\NewsItem;
use App\Models\NewsSetting;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name' => 'Owner Bengkel',
            'email' => 'admin@bengkel.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

        // Akun User
        User::create([
            'name' => 'Pelanggan 1',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'user',
        ]);

        // Data Service Dummy
        Service::create(['name' => 'Service Ringan', 'price' => 50000]);
        Service::create(['name' => 'Ganti Oli', 'price' => 75000]);

    }
}
