<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_en',
        'name_ar',
        'restaurant_id',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->{'name_' . app()->getLocale()}
        );
    }

    public function scopeFilter(Builder $query, string $filter = null, string $search = null, string $restaurant = null)
    {
        $user = Auth::user();
        // $query->with('restaurant');
        // if($user->isOwner()){
        //     $query->with('restaurant.user', function($q) use($user){
        //         $q->where('id', $user->id);
        //     });
        // }
        // if($filter==='trashed'){

        // }

        // $query
        // ->when($filters['search'] ?? null, function ($q, $search) {
        //     $q->where(function ($q) use ($search) {
        //         $q->where('name', 'like', "%{$search}%")
        //           ->orWhere('name_en', 'like', "%{$search}%");
        //     });
        // })

        // ->when($filters['trashed'] ?? null, function ($q, $trashed) {
        //     if ($trashed === 'only') {
        //         $q->onlyTrashed();
        //     } elseif ($trashed === 'with') {
        //         $q->withTrashed();
        //     }
        // })


        // ->when($user, function ($q) use ($user, $filters) {

        //     // Admin
        //     if ($user->isAdmin()) {
        //         $q->when($filters['restaurant_id'] ?? null, function ($q, $restaurantId) {
        //             $q->where('restaurant_id', $restaurantId);
        //         });
        //     }

        //     // Owner
        //     elseif ($user->isOwner()) {
        //         $q->where('restaurant_id', $user->restaurant_id);
        //     }
        // });

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
            function (Builder $q) use($restaurant) {
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
            function(Builder $q){
                $q->with('restaurant');
            }
        );
    }

    public function thumbnail()
    {
        return Storage::url($this->image_url);
    }


    protected static function booted()
    {
        static::deleting(function (Category $category) {
            $category->menuItems()->delete();
        });

        static::restoring(function (Category $category) {
            $category->menuItems()->restore();
        });
    }
}
