<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    // public function restaurant()
    // {
    //     return $this->hasOne(Restaurant::class);
    // }

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class,);
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
