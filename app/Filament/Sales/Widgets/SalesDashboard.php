<?php

namespace App\Filament\Sales\Widgets;

use Filament\Widgets\Widget;
use App\Models\Order;
use Illuminate\Support\Carbon;

class SalesDashboard extends Widget
{
    protected string $view = 'filament.sales.widgets.sales-dashboard';

    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 1;

    public string $statusFilter = '';

    public function getViewData(): array
    {
        $salesId = auth()->id();
        $isSalesRole = auth()->user()->hasRole('sales');

        $query = Order::query();

        if ($isSalesRole) {
            $query->where(function ($q) use ($salesId) {
                $q->where('sales_id', $salesId)
                  ->orWhereNull('sales_id');
            });
        }

        $orders = $query->whereNotIn('status', ['done', 'rejected'])
            ->orderBy('estimated_finish_date')
            ->get()
            ->map(function ($order) {
                $daysLeft = $order->estimated_finish_date
                    ? now()->diffInDays($order->estimated_finish_date, false)
                    : null;

                return [
                    'id'         => $order->order_code,
                    'customer'   => $order->customer_name,
                    'status'     => $order->status,
                    'days_left'  => $daysLeft,
                    'created_at' => $order->created_at->format('d M Y'),
                ];
            });

        $filtered = $this->statusFilter
            ? $orders->where('status', $this->statusFilter)
            : $orders;

        return [
            'orders'       => $filtered->values(),
            'total'        => $orders->count(),
            'pending'      => $orders->where('status', 'pending')->count(),
            'due_soon'     => $orders->filter(fn($o) => $o['days_left'] !== null && $o['days_left'] <= 3 && $o['days_left'] >= 0)->count(),
            'ready'        => $orders->where('status', 'ready_to_deliver')->count(),
            'status_counts' => $orders->groupBy('status')->map->count(),
            'urgent'       => $orders->filter(fn($o) => $o['days_left'] !== null && $o['days_left'] < 0)->values(),
            'due_today'    => $orders->filter(fn($o) => $o['days_left'] !== null && $o['days_left'] <= 3 && $o['days_left'] >= 0)->values(),
        ];
    }
}
