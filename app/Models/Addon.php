<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Addon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ar',
        'price',
        'user_id',
    ];

    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'menu_item_addon');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->belongsToMany(CartItem::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(get: fn() => $this->{'name_' . app()->getLocale()});
    }

    public function scopeFilter(Builder $query, string $search = null, string $user_id = null)
    {
        $user = Auth::user();
        
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
            $user_id !== null && $user_id !== 'all',
            function (Builder $q) use($user_id) {
                $q->where('user_id', $user_id);
            }
        );

        $query->when(
            $user->isOwner(),
            function (Builder $q) use ($user) {
                $q->where('user_id', $user->id);
            }
        );

        $query->when(
            $user->isAdmin(),
            function(Builder $q){
                $q->with('user');
            }
        );
    }
}
