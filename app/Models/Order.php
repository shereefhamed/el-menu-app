<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_type',
        'restaurant_id',
        'delivery_fee',
        'service_fee',
        'subtotal',
        'total',
        'customer_name',
        'address',
        'phone',
        'table_number',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orderId()
    {
        return "ORD-{$this->id}";
    }

    public function scopeOrderByOrderId(Builder $query, string $orderId)
    {
        $id = explode('-', $orderId);
        $actualOrderId = $id[1]?? null;
        $query->where('id', $actualOrderId);
    }
}
