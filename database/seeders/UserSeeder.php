<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Admin user
    User::create([
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('123456789'), // choose a strong password
        'role' => 'admin',
    ]);

    // Membre user
    User::create([
        'name' => 'salma',
        'email' => 'salma@gmail.com',
        'password' => Hash::make('123456'),
        'role' => 'membre',
    ]);
}
}
