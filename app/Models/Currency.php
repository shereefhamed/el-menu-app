<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    // public function restaurant()
    // {
    //     return $this->hasOne(Restaurant::class);
    // }

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class,);
    }
}
