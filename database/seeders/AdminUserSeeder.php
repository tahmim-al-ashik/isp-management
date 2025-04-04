<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@isp.com',
            'password' => Hash::make('password123'),  // Set a password for the admin
            'is_admin' => true,  // Flag to check if user is admin
        ]);
    }
}
