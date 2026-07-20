<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Prestasi', 'Kegiatan', 'Akademik', 'Kesiswaan',
            'Alumni', 'Informasi', 'Pengumuman', 'Olahraga',
            'Seni Budaya', 'Teknologi', 'Ekstrakurikuler', 'Liputan',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
