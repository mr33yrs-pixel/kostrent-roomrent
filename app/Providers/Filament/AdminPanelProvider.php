<?php

namespace App\Providers\Filament;

use App\Filament\Resources\RoomResource;
use App\Filament\Resources\SettingResource;
use App\Filament\Widgets\VisitorStatsOverview;
use App\Filament\Widgets\VisitsChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->spa()
            ->login()
            ->registration(false)
            ->passwordReset(false)
            ->brandName('JAI Premium Kost')
            ->brandLogo(asset('images/jai_logo.svg'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('images/favicon.png'))
            ->colors([
                'primary' => Color::Amber,
            ])
            ->resources([
                RoomResource::class,
                SettingResource::class,
            ])
            ->pages([
                Pages\Dashboard::class,
                \App\Filament\Pages\ManageSiteSettings::class,
                \App\Filament\Pages\ChangePassword::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                VisitorStatsOverview::class,
                VisitsChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                'throttle:5,1',
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
