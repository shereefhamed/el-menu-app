<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_en',
        'name_ar',
        'country_id',
    ];

    public function branches()
    {
        return $this->hasMany(Branche::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->{'name_' . app()->getLocale()}
        );
    }

    public function scopeFilter(Builder $query, string $search = null, string $filter = null, string $country = null)
    {
        if ($search) {
            $query->where('name_en', 'like', "%{$search}%");
        }
        if ($filter === 'trashed') {
            $query->onlyTrashed();
        }
        if ($country && $country !== 'all') {
            $query->whereRelation('country', 'name_en', $country);
        }
        $query->with('country')->latest();
    }

    protected static function booted()
    {
        static::deleting(function(City $city){
            $city->branches()->update(['city_id' => null]);
        });
    }
}
