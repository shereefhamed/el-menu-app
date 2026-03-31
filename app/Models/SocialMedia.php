<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
    ];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class)
            ->withPivot('url');
    }

    public function scopeFilter(Builder $query, string $search = null)
    {
        if($search){
            $query->where('name', "%{$search}%");
        }
        $query->latest();
    }

    
}
