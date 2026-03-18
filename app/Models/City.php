<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // public function restaurants()
    // {
    //     return $this->belongsToMany(related: Restaurant::class, table: 'restaurnt_city')
    //     ->withPivot('phone', 'address');
    // }

    public function branches()
    {
        return $this->hasMany(Branche::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->{'name_' . app()->getLocale()}
        );
    }
}
