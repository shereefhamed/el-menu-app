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

    public function isAdmin()
    {
        // return $this->role->name === 'admin';
        return $this->roles()->first()->name === 'admin';
    }

    public function role()
    {
        return $this->roles->first();
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

    protected static function booted()
    {
        static::deleting(function(User $user){
            $user->subscription()->delete();
            $user->payments()->delete();
        });

        static::restoring(function(User $user){
            $user->subscription()->restore();
            $user->payments()->restore();
        });
    }
}
