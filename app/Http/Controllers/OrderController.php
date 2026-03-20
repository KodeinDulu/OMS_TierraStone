<?php

namespace App\Http\Controllers;

use App\Models\FinishingType;
use App\Models\StoneType;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Tampilkan form order
    public function create()
    {
        $stoneTypes = StoneType::where('is_available', true)->get();
        $finishingTypes = FinishingType::where('is_available', true)->get();

        return view('order', compact('stoneTypes', 'finishingTypes'));
    }

    // Tampilkan halaman tracking
    public function track(Request $request)
    {
        // Jika ada parameter ?q=, return JSON
        if ($request->has('q')) {
            return $this->search($request);
        }

        // Kalau tidak, tampilkan halaman
        return view('orders-track');
    }

    public function search(Request $request)
    {
        $q = $request->input('q', '');

        if (strlen($q) < 3) {
            return response()->json([]);
        }

   
        $phoneQuery = preg_replace('/[\s\-\+]/', '', $q);    
        if (str_starts_with($phoneQuery, '62')) {
            $phoneQuery = substr($phoneQuery, 2);              
        } elseif (str_starts_with($phoneQuery, '0')) {
            $phoneQuery = substr($phoneQuery, 1);                
        }

        $isPhone = preg_match('/^\d{8,14}$/', $phoneQuery);

        $orders = Order::with('items.stoneType')
        ->where(function ($query) use ($q, $phoneQuery, $isPhone) {
            $query->where('order_code', 'LIKE', "%{$q}%")
            ->orWhere('customer_name', 'LIKE', "%{$q}%");

            if ($isPhone) {
                $query->orWhere('customer_phone', 'LIKE', "%{$phoneQuery}%");
            }
        })
            ->latest()
            ->limit(10)
            ->get()
            ->map(function ($order) {
                $firstItem = $order->items->first();

                return [
                    'id'        => $order->order_code,
                    'nama'      => $order->customer_name,
                    'phone'     => $order->customer_phone ? '+62' . $order->customer_phone : '—',
                    'email'     => $order->customer_email,
                    'produk'    => $firstItem?->stoneType?->name ?? '—',
                    'finishing' => $firstItem?->finishing ?? '—',
                    'dimensi'   => $firstItem ? "{$firstItem->width} × {$firstItem->height}" . ($firstItem->thickness ? " × {$firstItem->thickness}" : '') : '—',
                    'qty_pcs'   => $order->items->sum('quantity_pcs'),
                    'qty_sqm'   => $order->items->sum('quantity_sqm'),
                    'status'    => $order->status,
                    'production_status' => $order->production_status,
                    'catatan'   => $order->notes,
                    'tanggal'   => $order->created_at->format('d M Y'),
                    'items'     => $order->items->map(fn($item) => [
                        'stone'     => $item->stoneType?->name ?? '—',
                        'finishing' => $item->finishing ?? '—',
                        'dimensi'   => "{$item->width} × {$item->height}" . ($item->thickness ? " × {$item->thickness}" : ''),
                        'qty_pcs'   => $item->quantity_pcs,
                        'qty_sqm'   => $item->quantity_sqm,
                    ]),
                ];
            });

        return response()->json($orders);
    }
}
