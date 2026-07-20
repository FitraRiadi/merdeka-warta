<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Gallery;
use App\Policies\ArticlePolicy;
use App\Policies\GalleryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Gallery::class => GalleryPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}