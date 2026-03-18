<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute as ModelAttribute;

class Attribute extends Model
{
    use HasFactory;

    // public function variations()
    // {
    //     return $this->hasMany(Variation::class);
    // }

    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'menu_item_attribute')
            ->withPivot('price');
    }

    protected function name(): ModelAttribute
    {
        return ModelAttribute::make(
            get: fn() => $this->{'name_' . app()->getLocale()}
        );
    }
}
