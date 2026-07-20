<?php

namespace Database\Seeders;

use App\Models\AnnouncementCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AnnouncementCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Informasi', 'type' => 'info'],
            ['name' => 'Peringatan', 'type' => 'warning'],
            ['name' => 'Penting', 'type' => 'important'],
        ];

        foreach ($categories as $cat) {
            AnnouncementCategory::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'type' => $cat['type'],
                ]
            );
        }
    }
}
