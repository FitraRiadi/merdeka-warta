<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Article;
use App\Models\Spotlight;
use Illuminate\Database\Seeder;

class SpotlightSeeder extends Seeder
{
    public function run(): void
    {
        // Article spotlights (max 3)
        $articles = Article::where('is_published', true)->take(3)->get();

        foreach ($articles as $article) {
            Spotlight::create([
                'type' => 'article',
                'article_id' => $article->id,
            ]);
        }

        // Announcement spotlight (max 1)
        $announcement = Announcement::where('is_active', true)->first();
        if ($announcement) {
            Spotlight::create([
                'type' => 'announcement',
                'announcement_id' => $announcement->id,
            ]);
        }
    }
}
