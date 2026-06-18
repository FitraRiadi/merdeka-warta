<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['name' => 'Ahmad Fauzi', 'email' => 'ahmad@merdekawarta.com'],
            ['name' => 'Siti Rahayu', 'email' => 'siti@merdekawarta.com'],
            ['name' => 'Budi Santoso', 'email' => 'budi@merdekawarta.com'],
        ];

        foreach ($authors as $author) {
            User::create([
                'name' => $author['name'],
                'email' => $author['email'],
                'password' => Hash::make('password'),
                'role' => 'author',
            ]);
        }
    }
}