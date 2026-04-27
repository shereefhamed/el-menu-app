<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_type',
        'restaurant_id',
        'delivery_fee',
        'service_fee',
        'subtotal',
        'total',
        'customer_name',
        'address',
        'phone',
        'table_number',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orderId()
    {
        return "ORD-{$this->id}";
    }

    public function scopeOrderByOrderId(Builder $query, string $orderId)
    {
        $id = explode('-', $orderId);
        $actualOrderId = $id[1] ?? null;
        $query->where('id', $actualOrderId);
    }

    public function orderCanCancelled()
    {
        return $this->status === 'pending';
    }

    public function scopeFilter(Builder $query, ?string $restaurant, ?string $customer, ?string $from, ?string $to)
    {
        $user = Auth::user();
        $query->with('user');

        $query->when(
            $restaurant !== null && $restaurant !== 'all',
            function (Builder $q) use ($restaurant) {
                $q->where('restaurant_id', $restaurant);
            }
        );

        $query->when(
            $customer !== null && $customer !== 'all',
            function (Builder $q) use ($customer) {
                $q->where('user_id', $customer);
            }
        );

        $query->when(
            $from && !$to,
            function ($q) use ($from) {
                $q->where('created_at', '>=', $from);
            }
        );

        $query->when(
            !$from && $to,
            function ($q) use ($to) {
                $q->where('created_at', '<=', $to);
            }
        );

        $query->when(
            $from && $to,
            function ($q) use ($from, $to) {
                $q->whereBetween('created_at', [$from, $to]);
            }
        );

        $query->when(
            $user->isOwner(),
            function (Builder $q) use ($user) {
                $q->whereHas('restaurant.user', function ($q) use ($user) {
                    $q->where('id', $user->id);
                });
            }
        );

        $query->when(
            $user->isAdmin(),
            function (Builder $q) {
                $q->with('restaurant');
            }
        );
    }
}
