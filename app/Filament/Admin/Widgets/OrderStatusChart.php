<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;

class OrderStatusChart extends ChartWidget
{
    protected ?string $heading = 'Order Status Chart';

    protected function getData(): array
    {
        // Count each status except finished
        $statuses = ['pending', 'on_hold', 'on_progress'];

        $data = [];
        $labels = [];

        foreach ($statuses as $status) {
            $count = Order::where('status', $status)->count();
            $data[] = $count;
            $labels[] = match($status) {
                'pending'     => 'Pending',
                'on_hold'     => 'On Hold',
                'on_progress' => 'On Progress',
            };
        }

        return [
            'datasets' => [
                [
                    'data'            => $data,
                    'backgroundColor' => [
                        '#f59e0b', // pending - warning
                        '#6b7280', // on_hold - gray
                        '#3b82f6', // on_progress - blue
                    ],
                ],
            ],
            'labels' => $labels,
        ];

    }

    protected function getType(): string
    {
        return 'pie';
    }
}
