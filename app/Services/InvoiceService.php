<?php

namespace App\Services;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class InvoiceService
{
    public function download(Order $order): Response
    {
        $order->loadMissing('items.stoneType');

        $pdf = Pdf::loadView('invoices.order', [
            'order'    => $order,
            'items'    => $order->items,
            'subtotal' => $this->subtotal($order),
            'date'     => now()->locale('id')->isoFormat('D MMMM YYYY'),
        ])
            ->setPaper('a4', 'portrait')
            ->setOption('dpi', 150)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', false);

        $filename = 'Invoice-' . $order->order_code . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Stream (preview in browser) instead of forcing download.
     */
    public function stream(Order $order): Response
    {
        $order->loadMissing('items.stoneType');

        $pdf = Pdf::loadView('invoices.order', [
            'order'    => $order,
            'items'    => $order->items,
            'subtotal' => $this->subtotal($order),
            'date'     => now()->locale('id')->isoFormat('D MMMM YYYY'),
        ])
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Invoice-' . $order->order_code . '.pdf');
    }

    private function subtotal(Order $order): int
    {
        return $order->items->sum(function ($item) {
            return ($item->unit_price ?? 0) * ($item->quantity ?? 0);
        });
    }
}
