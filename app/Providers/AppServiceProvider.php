<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            $settings = Setting::pluck('value', 'key')->toArray();
            View::share('globalSettings', $settings);
        } catch (\Throwable $e) {
            View::share('globalSettings', []);
        }
    }
}
