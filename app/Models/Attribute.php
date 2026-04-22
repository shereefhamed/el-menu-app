<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute as ModelAttribute;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'menu_item_attribute')
            ->withPivot('price');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    protected function name(): ModelAttribute
    {
        return ModelAttribute::make(
            get: fn() => $this->{'name_' . app()->getLocale()}
        );
    }

    public function scopeFilter(Builder $query, string $search = null)
    {
        if ($search) {
            $query->where('name_en', 'like', "%{$search}%")
                ->orWhere('name_ar', 'like', "%{$search}%")
                ->latest();
        }
    }
}
