<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'menu_item_id',
        'attribute_id',
        'quantity',
        'notes',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // public function menuItems()
    // {
    //     return $this->hasMany(MenuItem::class);
    // }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, );
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function addons()
    {
        return $this->belongsToMany(Addon::class);
    }
}
