<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function scopeCartItemByMenuItemAndAddonAndAttribute(Builder $query, string $menuItemId, string $attributeId = null, array $addonIds)
    {
        $query->with('cartItems')
            ->where('menu_item_id', $menuItemId)
            ->where('attribute_id', $attributeId)
            ->whereHas('addons', function ($q) use ($addonIds) {
                $q->whereIn('addon_id', $addonIds);
            }, '=', count($addonIds))
            ->whereDoesntHave('addons', function ($q) use ($addonIds) {
                $q->whereNotIn('addon_id', $addonIds);
            });
    }
}
