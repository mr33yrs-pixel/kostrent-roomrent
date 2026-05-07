<?php

namespace App\Filament\Widgets;

use App\Models\Visit;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class VisitsChart extends ChartWidget
{
    protected static ?string $heading = 'Visits Over Time';
    protected static ?string $pollingInterval = null;

    // Sort order on dashboard
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        // Cache only raw data arrays, NOT closures or objects.
        $data = Cache::remember('admin_visits_chart', 3600, function () {
            $startDate = now()->subDays(30)->startOfDay();
            $endDate = now()->endOfDay();

            // Use raw SQL group-by for performance instead of external package
            $visits = Visit::query()
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
                ->where('created_at', '>=', $startDate)
                ->where('created_at', '<=', $endDate)
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('date')
                ->get()
                ->pluck('total', 'date')
                ->toArray();

            // Fill in missing dates with zero
            $labels = [];
            $values = [];
            $current = $startDate->copy();
            while ($current->lte($endDate)) {
                $dateStr = $current->format('Y-m-d');
                $labels[] = $current->format('M d');
                $values[] = $visits[$dateStr] ?? 0;
                $current->addDay();
            }

            return ['labels' => $labels, 'values' => $values];
        });

        return [
            'datasets' => [
                [
                    'label' => 'Page Views',
                    'data' => $data['values'],
                    'borderColor' => '#F4A261',
                    'backgroundColor' => 'rgba(244, 162, 97, 0.2)',
                ],
            ],
            'labels' => $data['labels'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
