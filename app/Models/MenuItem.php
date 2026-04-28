<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute as ModelAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'restaurant_id',
        'category_id',
        'price',
    ];

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

    // public function cartItem()
    // {
    //     return $this->belongsTo(CartItem::class);
    // }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, );
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
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
        if (Str::contains($this->image_url, 'http')) {
            return $this->image_url;
        }
        return Storage::url($this->image_url);
    }

    public function isVariable()
    {
        if ($this->attributes->isEmpty()) {
            return true;
        }
        return false;
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFilter(Builder $query, string $filter = null, string $search = null, string $restaurant = null)
    {
        $user = Auth::user();

        $query->with('category');

        $query->when(
            $filter === 'trashed',
            function (Builder $q) {
                $q->onlyTrashed();
            }
        );

        $query->when(
            $search,
            function (Builder $q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name_ar', 'like', "%{$search}%")
                        ->orWhere('name_en', 'like', "%{$search}%");
                });
            }
        );

        $query->when(
            $restaurant !== null && $restaurant !== 'all',
            function (Builder $q) use ($restaurant) {
                $q->where('restaurant_id', $restaurant);
            }
        );

        $query->when(
            $user->isOwner(),
            function (Builder $q) use ($user) {
                $q->whereHas('restaurant.user', function ($q) use ($user) {
                    $q->where('id', $user->id);
                });
            }
        );

        $query->when(
            $user->isAdmin(),
            function (Builder $q) {
                $q->with('restaurant');
            }
        );
    }

    protected static function booted()
    {
        static::creating(function (MenuItem $menuItem) {
            // $menuItem->slug = Str::slug($menuItem->name_en);
            $baseSlug = Str::slug($menuItem->name_en);
            $slug = $baseSlug;
            $count = 1;

            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }

            $menuItem->slug = $slug;
        });

        static::saving(function (MenuItem $menuItem) {
            $menuItem->slug = Str::slug($menuItem->name_en);
        });

        static::deleting(function (MenuItem $menuItem) {
            $menuItem->addons()->sync([]);
            $menuItem->attributes()->sync([]);
        });
    }
}
