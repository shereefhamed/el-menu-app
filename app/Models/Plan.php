<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'amount',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    protected static function booted()
    {
        static::deleting(function (Plan $plan) {
            $plan->payments()->update(['plan_id' => null]);
        });
    }

    protected function name(): Attribute
    {
        return Attribute::get(
            get: fn() => $this->{'name_' . app()->getLocale()}
        );
    }
}
