<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
