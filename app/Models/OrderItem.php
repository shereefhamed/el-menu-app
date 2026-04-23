<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'menu_item_id',
        'item_name',
        // 'base_price',
        'unit_price',
        'total',
        'addons',
        'attribute',
        'notes',
    ];

    protected $casts = [
        'addons' => 'array',
        'attribute' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
