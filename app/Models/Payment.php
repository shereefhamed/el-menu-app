<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'transaction_id',
        'amount',
        'plan_id',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter(Builder $query, string $from = null, string $to = null)
    {
        if ($from && !$to) {
            $query->with('plan', 'user')->where('created_at', '>=', $from)->latest();
        } else if (!$from && $to) {
            $query->with('plan', 'user')->where('created_at', '<=', $to)->latest();
        } else if ($from && $to) {
            $query->with('plan', 'user')->whereBetween('created_at', [$from, $to])->latest();
        }
        $query->withTrashed();
    }
}
