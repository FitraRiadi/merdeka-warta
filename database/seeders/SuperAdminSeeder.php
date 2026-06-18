<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin SMK Merdeka',
            'email' => 'superadmin@merdekawarta.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);
    }
}