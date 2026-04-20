<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Forms\Components\Select;

class OrderSummaryTable extends BaseWidget
{
    public string $filter = 'last_week';

    protected function getFilters(): array
    {
        return [
            'last_week'     => 'Last Week',
            'last_month'    => 'Last Month',
            'last_3_months' => 'Last 3 Months',
        ];
    }

    protected function getStats(): array
    {
        $startDate = match($this->filter) {
            'last_week'     => now()->subWeek(),
            'last_month'    => now()->subMonth(),
            'last_3_months' => now()->subMonths(3),
            default         => now()->subWeek(),
        };

        $done = Order::where('status', 'done')
            ->whereNotNull('completed_at')
            ->where('completed_at', '>=', $startDate)
            ->count();

        $rejected = Order::where('status', 'rejected')
            ->whereNotNull('completed_at')
            ->where('completed_at', '>=', $startDate)
            ->count();

        $total = $done + $rejected;

        $periodLabel = $this->getFilters()[$this->filter];

        return [
            Stat::make('Order Selesai (Done)', $done)
                ->description('Periode: ' . $periodLabel)
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Order Ditolak (Rejected)', $rejected)
                ->description('Periode: ' . $periodLabel)
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),

            Stat::make('Total', $total)
                ->description('Done + Rejected')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('primary'),
        ];
    }
}
