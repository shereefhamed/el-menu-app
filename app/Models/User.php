<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function restaurant()
    {
        return $this->hasOne(Restaurant::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function isAdmin()
    {
        // return $this->role->name === 'admin';
        return $this->role()->name === 'admin';
    }

    public function isOwner()
    {
        return $this->role()->name === 'owner';
    }

    public function isCustomer()
    {
        return $this->role()->name === 'cusotmer';
    }

    public function role()
    {
        return $this->roles->first();
    }

    public function addons()
    {
        return $this->hasMany(Addon::class);
    }

    public function scopeFilter(Builder $query, string $search = null, string $filter = null)
    {
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        if ($filter === 'trashed') {
            $query->onlyTrashed();
        }

        $query->with('roles')->latest();
    }

    public function scopeAdmins(Builder $query)
    {
        $adminRole = Role::admin()->first();
        $query->whereHas('roles', function (Builder $query) use ($adminRole) {
            $query->where('roles.id', $adminRole->id);
        });
    }

    public function scopeOwners(Builder $query)
    {
        $ownerRole = Role::owner()->first();
        $query->whereHas('roles', function (Builder $query) use ($ownerRole) {
            $query->where('roles.id', $ownerRole->id);
        });
    }

    public function scopeOwnerWithoutRestaurant(Builder $query)
    {

        $query->owners()
            ->doesntHave('restaurant');
    }

    public function getRedirectRoute()
    {
        return match ($this->role()->name) {
            'owner' => $this->restaurant ? '/dashboard' : route('restaurants.create'),
            'customer' => '/',
            'admin' => '/dashboard',
            default => '/',
        };
    }

    protected static function booted()
    {
        static::deleting(function (User $user) {
            $user->subscription()->delete();
            $user->payments()->delete();
            $user->restaurant()->delete();
            $user->addons()->delete();
        });

        static::restoring(function (User $user) {
            $user->subscription()->restore();
            $user->payments()->restore();
            $user->restaurant()->restore();
        });
    }
}
