<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'price',
        'options'
    ];

    protected $casts = [
        'options' => 'array',
        'end_at' => 'datetime',
        'start_at' => 'datatime',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    protected function name(): Attribute
    {
        return Attribute::get(
            get: fn() => $this->{'name_' . app()->getLocale()}
        );
    }
    protected function description(): Attribute
    {
        return Attribute::get(
            get: fn() => $this->{'description_' . app()->getLocale()}
        );
    }

    public function scopeFree(Builder $query)
    {
        $query->where('name_en', 'free')
            ->orWhere('price', 0);
    }

    public function scopePaid(Builder $query)
    {
        $query->where('price', '>', 0)->orderBy('price');
    }

    public function isFree()
    {
        return $this->price === 0 || $this->name_en === 'free' || $this->name_en === 'Free';
    }

    public function isPro()
    {
        return $this->name_en == 'pro' || $this->name_en === 'Pro';
    }

    public function isEnterprise()
    {
        return $this->name_en === 'Enterprise' || $this->name_en === 'enterprise';
    }

    public function canCreateQrCode()
    {
        return $this->options['create_qr_code'] ?? false;
    }

    public function numberOfCategories()
    {
        if (array_key_exists('number_of_categories', $this->options)) {
            if ($this->options['number_of_categories'] === 'unlimited') {
                return PHP_INT_MAX;
            } else {
                return $this->options['number_of_categories'];
            }
        }
        return 0;
    }

    public function landingpageCategoriesPrashe()
    {
        if (array_key_exists('number_of_categories', $this->options)) {
            if ($this->options['number_of_categories'] === 'unlimited') {
                return __('Create unlimited categories');
            } else {
                return __('Create :number categories', ['number' => $this->options['number_of_categories']]);
            }
        }
    }

    public function landingpageItemsPrashe()
    {
        if (array_key_exists('number_of_items', $this->options)) {
            if ($this->options['number_of_items'] === 'unlimited') {
                return __('Create unlimited items');
            } else {
                return __('Create :number items', ['number' => $this->options['number_of_items']]);
            }
        }
    }

    public function numberOfItems()
    {
        if (array_key_exists('number_of_items', $this->options)) {
            if ($this->options['number_of_items'] === 'unlimited') {
                return PHP_INT_MAX;
            } else {
                return $this->options['number_of_items'];
            }
        }
        return 0;
    }

    protected static function booted()
    {
        static::deleting(function (Plan $plan) {
            $plan->payments()->update(['plan_id' => null]);
        });
    }
}
