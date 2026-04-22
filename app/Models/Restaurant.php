<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'restaurant_type_id',
        'logo',
        'currency_id',
        'user_id',
    ];

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
        return $this->belongsTo(RestaurantType::class, 'restaurant_type_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function branches()
    {
        return $this->hasMany(Branche::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeSubscripedRestaturants(Builder $builder)
    {

        $builder->with('categories.menuItems')
            ->whereRelation('user.subscription', 'end_at', '>=', now());

    }

    public function scopeSubscripedRestaturant(Builder $builder, string $slug)
    {

        $builder->subscripedRestaturants()
            ->where('slug', $slug);
    }

    public function logo()
    {
        if(!$this->logo){
            return 'https://placehold.net/400x400.png';
        }
        return Storage::url($this->logo);
    }

    public function scopeFilter(Builder $query, string $fitler = null, string $userId = null, string $search = null)
    {

        $query->when(
            $fitler === 'trashed',
            function ($q) {
                $q->onlyTrashed();
            }
        );

        $query->when(
            $userId,
            function ($q) use ($userId) {
                $q->where('user_id', $userId);
            }
        );

        $query->when(
            $search,
            function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            }
        );

        $query->with('user', 'currency', 'type');
    }

    public function scopeRestaurantSearch(Builder $query, string $foodType = null, string $country = null, string $city = null)
    {
        $query->subscripedRestaturants();
        $query->when(
            $foodType,
            function ($q) use ($foodType) {
                $q->where('restaurant_type_id', $foodType);
            }
        );
        $query->when(
            $country,
            function($q) use($country){
                $q->whereHas(
                    'branches.city',
                    function($q) use($country){
                        $q->where('country_id', $country);
                    }
                );
            }
        );
        $query->when(
            $city,
            function ($q) use ($city) {
                $q->whereHas(
                    'branches',
                    function($q) use($city){
                        $q->where('city_id', $city);
                    }
                );
            }
        );
    }

    protected static function booted()
    {
        static::creating(function (Restaurant $restaurant) {
            $restaurant->slug = Str::slug($restaurant->name);
        });

        static::saving(function (Restaurant $restaurant) {
            $restaurant->slug = Str::slug($restaurant->name);
        });

        static::deleting(function (Restaurant $restaurant) {
            $restaurant->categories()->delete();
            $restaurant->menuItems()->delete();
            $restaurant->branches()->delete();
        });

        static::restoring(function (Restaurant $restaurant) {
            $restaurant->categories()->restore();
            $restaurant->menuItems()->restore();
        });
    }

}
