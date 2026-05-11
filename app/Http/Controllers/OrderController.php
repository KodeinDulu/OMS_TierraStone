<?php

namespace App\Http\Controllers;

use App\Models\FinishingType;
use App\Models\StoneType;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Str; 

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
                    'address'   => $order->customer_address,
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

// Simpan order baru dari form publik (tanpa login)
    public function store(Request $request)
    {
        $request->validate([
            'customer_name'     => 'required|string|max:255',
            'customer_phone'    => 'required|string|max:20',
            'customer_address'  => 'required|string|max:500',
            'notes'             => 'nullable|string|max:1000',
            'items'             => 'required|array|min:1',
            'items.*.product'   => 'required|string',
            'items.*.qty'       => 'required|integer|min:1',
            'items.*.length'    => 'required|numeric|min:1',
            'items.*.width'     => 'required|numeric|min:1',
            'items.*.thickness' => 'nullable|numeric|min:0',
            'items.*.luas'      => 'nullable|numeric|min:0',
            'items.*.finishing' => 'nullable|string',
        ]);
 
        // Bersihkan nomor HP: strip +62 atau 62 di depan, simpan tanpa awalan
        $phone = preg_replace('/[\s\-\+]/', '', $request->customer_phone);
        if (str_starts_with($phone, '62')) {
            $phone = substr($phone, 2);
        } elseif (str_starts_with($phone, '0')) {
            $phone = substr($phone, 1);
        }
 
        // Generate order_code unik: TS-YYYYMMDD-XXXX
        do {
            $orderCode = 'TS-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
        } while (Order::where('order_code', $orderCode)->exists());
 
        // sales_id: form publik tanpa login, pakai ID 1 (admin default)
        // Ganti dengan ID user/sales yang sesuai jika perlu
        $salesId = 1;
 
        $order = Order::create([
            'order_code'       => $orderCode,
            'sales_id'         => $salesId,
            'customer_name'    => $request->customer_name,
            'customer_phone'   => $phone,
            'customer_address' => $request->customer_address,
            'notes'            => $request->notes,
            'status'           => 'indent',
        ]);
 
        foreach ($request->items as $itemData) {
            $stone = StoneType::where('name', $itemData['product'])->first();
 
            if (!$stone) {
                $order->forceDelete();
                return response()->json([
                    'success' => false,
                    'message' => "Jenis batu '{$itemData['product']}' tidak ditemukan.",
                ], 422);
            }
 
            $finishingId = null;
            if (!empty($itemData['finishing'])) {
                $finishing   = FinishingType::where('name', $itemData['finishing'])->first();
                $finishingId = $finishing?->id;
            }
 
            OrderItem::create([
                'order_id'          => $order->id,
                'stone_type_id'     => $stone->id,
                'finishing_type_id' => $finishingId,
                'height'            => $itemData['length'],   // height di DB = panjang di form
                'width'             => $itemData['width'],
                'thickness'         => $itemData['thickness'] ?? 0,
                'quantity_pcs'      => $itemData['qty'],
                'quantity_sqm'      => !empty($itemData['luas']) ? $itemData['luas'] : null,
            ]);
        }
 
        return response()->json([
            'success'    => true,
            'order_id'   => $order->id,
            'order_code' => $order->order_code,
        ], 201);
    }
    
    }