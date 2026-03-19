<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_code', 'sales_id', 'customer_name',
        'customer_phone', 'customer_email', 'status', 'production_status', 'notes', 'freight', 'updated_by',
        'reference_image'
    ];

    protected $casts = [
        'reference_image' => 'array',
    ];

    public function sales() { return $this->belongsTo(User::class, 'sales_id'); }
    public function updatedBy() { return $this->belongsTo(User::class, 'updated_by'); }
    public function items() { return $this->hasMany(OrderItem::class); }

    protected static function booted()
    {
        static::creating(function ($order) {
            $order->order_code = 'ORD-' . strtoupper(uniqid());
        });
    }

    public function getReferenceImageUrlsAttribute(): array
    {
        if (!$this->reference_image) return [];

        return array_map(
            fn($path) => asset('storage/' . $path),
            $this->reference_image
        );
    }
}
