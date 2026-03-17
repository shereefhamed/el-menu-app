<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute as ModelAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // public function variations()
    // {
    //     return $this->hasMany(Variation::class);
    // }

    public function attribures()
    {
        return $this->belongsToMany(Attribute::class, 'menu_item_attribute')
            ->withPivot('price');
    }

    protected function name(): ModelAttribute
    {
        return ModelAttribute::make(
            get: fn() => $this->{'name_' . app()->getLocale()}
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
}
