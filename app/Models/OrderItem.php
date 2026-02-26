<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'stone_type_id',
        'finishing',
        'width',
        'height',
        'quantity'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function stoneType()
    {
        return $this->belongsTo(StoneType::class);
    }

    public function getSizeAttribute(): string
    {
        return "{$this->width} x {$this->height}";
    }
}
