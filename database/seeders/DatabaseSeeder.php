<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'nama' => 'Admin Laundry',
            'email' => 'admin@laundry.com',
            'password' => Hash::make('password'),
            'peran' => 'admin',
            'telepon' => '081234567890',
            'alamat' => 'Jl. Admin No. 1',
        ]);

        // Create sample customer
        User::create([
            'nama' => 'Customer Test',
            'email' => 'customer@test.com',
            'password' => Hash::make('password'),
            'peran' => 'pelanggan',
            'telepon' => '081234567891',
            'alamat' => 'Jl. Customer No. 1',
        ]);

        // Create services
        Service::create([
            'name' => 'Cuci Kering',
            'description' => 'Layanan cuci dan kering pakaian',
            'price_per_kg' => 5000,
            'estimated_days' => 2,
        ]);

        Service::create([
            'name' => 'Cuci Setrika',
            'description' => 'Layanan cuci, kering, dan setrika pakaian',
            'price_per_kg' => 7000,
            'estimated_days' => 3,
        ]);

        Service::create([
            'name' => 'Setrika Saja',
            'description' => 'Layanan setrika pakaian saja',
            'price_per_kg' => 3000,
            'estimated_days' => 1,
        ]);
    }
}