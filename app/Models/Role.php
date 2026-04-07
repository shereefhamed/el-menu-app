<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // public function user()
    // {
    //     // return $this->belongsTo(User::class);
    //     return $this->hasOne(User::class);
    // }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function scopeOwner(Builder $query)
    {
        $query->where('name', 'owner') ;
    }

    public function scopeAdmin(Builder $query)
    {
        $query->where('name', 'admin') ;
    }
}
