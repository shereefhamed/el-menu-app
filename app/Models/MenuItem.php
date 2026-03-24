<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute as ModelAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuItem extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'menu_item_attribute')
            ->withPivot('price');
    }

    public function addons()
    {
        return $this->belongsToMany(Addon::class, 'menu_item_addon');
    }

    protected function name(): ModelAttribute
    {
        return ModelAttribute::make(
            get: fn() => $this->{'name_' . app()->getLocale()}
        );
    }

    protected function description(): ModelAttribute
    {
        return ModelAttribute::make(
            get: fn() => $this->{'description_' . app()->getLocale()}
        );
    }

    public function thumbnail()
    {
        return 'https://placehold.net/product-400x400.png';
    }

    public function isVariable()
    {
        if ($this->has('variations')) {
            return true;
        }
        return false;
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function booted()
    {
        static::creating(function(MenuItem $menuItem){
            $menuItem->slug = Str::slug($menuItem->name_en);
        });
    }
}
