<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->{'name_' . app()->getLocale()}
        );
    }

    public function scopeFilter(Builder $query, string $search = null , string $filter = null)
    {
        if($search){
            $query->where('name_en', 'like', "%{$search}%");
        }
        if($filter==='trashed'){
            $query->onlyTrashed();
        }
        $query->latest();
    }

    protected static function booted()
    {
        static::deleting(function(Country $country){
            $country->cities()->delete();
        });

        static::restoring(function(Country $country){
            $country->cities()->restore();
        });
    }
}
