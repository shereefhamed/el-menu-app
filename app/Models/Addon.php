<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'menu_item_addon');
    }

    protected function name(): Attribute
    {
        return Attribute::make(get: fn() => $this->{'name_' . app()->getLocale()});
    }
}
