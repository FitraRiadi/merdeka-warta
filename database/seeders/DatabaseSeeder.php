<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            HiddenSuperAdminSeeder::class,
            SuperAdminSeeder::class,
            AuthorSeeder::class,
            ArticleSeeder::class,
            AnnouncementSeeder::class,
            RunningTextSeeder::class,
            SpotlightSeeder::class,
            GallerySeeder::class,
        ]);
    }
}