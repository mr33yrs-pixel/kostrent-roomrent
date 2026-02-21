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

        // Share common settings with all views to avoid repeated Setting::getByKey() calls
        // Only attach site settings to the visitor layout — NOT admin/Filament views
        \Illuminate\Support\Facades\View::composer('components.layouts.app', function ($view) {
            $view->with('siteSettings', [
                'contact_address'  => \App\Models\Setting::getByKey('contact_address'),
                'contact_email'    => \App\Models\Setting::getByKey('contact_email', config('app.contact_email')),
                'contact_whatsapp' => \App\Models\Setting::getByKey('contact_whatsapp', config('app.whatsapp_number')),
                'social_facebook'  => \App\Models\Setting::getByKey('social_facebook'),
                'social_instagram' => \App\Models\Setting::getByKey('social_instagram'),
                'social_tiktok'    => \App\Models\Setting::getByKey('social_tiktok'),
                'social_x'         => \App\Models\Setting::getByKey('social_x'),
            ]);
        });
    }
}
