<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Restaurant extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function socialMedia()
    {
        return $this->belongsToMany(SocialMedia::class)
            ->withPivot('url');
    }

    public function type()
    {
        return $this->belongsTo(RestaurantType::class);
    }

    // public function cities()
    // {
    //     return $this->belongsToMany(City::class, 'restaurnt_city')
    //     ->withPivot('phone', 'address');
    // }

    public function branches()
    {
        return $this->hasMany(Branche::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function booted()
    {
        static::creating(function (Restaurant $restaurant) {
            $restaurant->slug = Str::slug($restaurant->name);
        });
    }

}
