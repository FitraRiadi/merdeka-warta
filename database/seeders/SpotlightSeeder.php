<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Spotlight;
use Illuminate\Database\Seeder;

class SpotlightSeeder extends Seeder
{
    public function run(): void
    {
        $articles = Article::where('is_published', true)->take(3)->get();

        $badges = ['LATEST NEWS', 'HIGHLIGHT', 'SUCCESS STORY'];

        foreach ($articles as $i => $article) {
            Spotlight::create([
                'article_id' => $article->id,
                'badge_label' => $badges[$i] ?? 'FEATURED',
                'sort_order' => $i,
                'is_active' => true,
            ]);
        }
    }
}
