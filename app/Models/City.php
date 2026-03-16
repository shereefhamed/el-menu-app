<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function restaurants()
    {
        return $this->belongsToMany(related: Restaurant::class, table: 'restaurnt_city')
        ->withPivot('phone', 'address');
    }
}
