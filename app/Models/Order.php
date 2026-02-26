<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_code', 'sales_id', 'customer_name',
        'customer_phone', 'customer_email', 'status', 'notes', 'updated_by'
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
}
