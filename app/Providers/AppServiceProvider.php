<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(!app()->isProduction());
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());

        // Share common settings with all views — single cache read instead of 7 individual calls
        \Illuminate\Support\Facades\View::composer('components.layouts.app', function ($view) {
            $all = \Illuminate\Support\Facades\Cache::rememberForever('settings', function () {
                return \App\Models\Setting::pluck('value', 'key')->toArray();
            });

            $view->with('siteSettings', [
                'contact_address'  => $all['contact_address'] ?? null,
                'contact_email'    => $all['contact_email'] ?? config('app.contact_email'),
                'contact_whatsapp' => $all['contact_whatsapp'] ?? config('app.whatsapp_number'),
                'social_facebook'  => $all['social_facebook'] ?? null,
                'social_instagram' => $all['social_instagram'] ?? null,
                'social_tiktok'    => $all['social_tiktok'] ?? null,
                'social_x'         => $all['social_x'] ?? null,
            ]);
        });
    }
}
