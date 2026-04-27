<?php
namespace App\Services;

use App\Models\Restaurant;

class OrderPricingService
{
    public function __construct(public Restaurant $restaurant) {
        
    }
    public function calculate(string $type, float $subtotal): array
    {
        $deliveryFee = 0;
        $serviceFee = 0;

        if ($type === 'delivery') {
            $deliveryFee = $this->restaurant->delivery_fee;
        }

        // if ($type === 'pickup') {
        //     $serviceFee = 5;
        // }

        if ($type === 'dine_in' || $type === 'pickup') {
            $serviceFee = $subtotal * ($this->restaurant->service_fee??0) /100; 
        }

        $total = $subtotal + $deliveryFee + $serviceFee;

        // return compact(
        //     'subtotal',
        //     'deliveryFee',
        //     'serviceFee',
        //     'total'
        // );

        $pricing = [
            'deliveryFee' => $deliveryFee,
            'serviceFee' => $serviceFee,
            'total' => $total,
        ];
        return $pricing;
    }
}