<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;

class OrderStatusChart extends ChartWidget
{
    protected ?string $heading = 'Order Status Chart';

    protected function getData(): array
    {
        $statuses = ['pending', 'on_progress', 'ready_to_deliver', 'on_deliver'];

        $data = [];
        $labels = [];

        foreach ($statuses as $status) {
            $count = Order::where('status', $status)->count();
            $data[] = $count;
            $labels[] = match($status) {
                'pending'           => 'Pending',
                'on_progress'       => 'On Progress',
                'ready_to_deliver'  => 'Ready to Deliver',
                'on_deliver'        => 'On Deliver',
            };
        }

        return [
            'datasets' => [
                [
                    'data'            => $data,
                    'backgroundColor' => [
                        '#f59e0b', // pending - amber
                        '#8b5cf6', // on_progress - purple
                        '#10b981', // ready_to_deliver - green
                        '#3b82f6', // on_deliver - blue
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
