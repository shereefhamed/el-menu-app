<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = Payment::with('user', 'plan')->get();

        $payments->each(function(Payment $payment){
            Subscription::create([
                'user_id' => $payment->user->id,
                'plan_id' => $payment->plan->id,
                'start_at' => $payment->created_at,
                'end_at' => $payment->created_at->addMonth(),
            ]);
        });
    }
}
