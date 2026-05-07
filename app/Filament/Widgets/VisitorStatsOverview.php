<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

class VisitorStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        // Cache only the raw data (arrays/scalars), NOT Stat objects.
        // Stat objects contain closures and are not serializable with file/database cache drivers.
        $data = Cache::remember('admin_visitor_stats', 3600, function () {
            $now = Carbon::now();

            return [
                'total'   => Visit::count(),
                'monthly' => Visit::where('created_at', '>=', $now->copy()->startOfMonth())->count(),
                'unique'  => Visit::distinct()->count('ip_address'),
            ];
        });

        return [
            Stat::make('Total Visits', $data['total'])
                ->description('All time page views')
                ->descriptionIcon('heroicon-m-eye')
                ->color('success'),

            Stat::make('Unique Visitors', $data['unique'])
                ->description('Based on IP address')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('This Month', $data['monthly'])
                ->description('Page views this month')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning'),
        ];
    }
}
