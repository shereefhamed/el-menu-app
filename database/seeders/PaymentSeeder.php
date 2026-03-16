<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owners = User::whereHas('role', function ($query) {
            $query->where('name', 'owner');
        })->get();
        $plans = Plan::all();

        $owners->each(function(User $owner) use($plans){
            $plan = $plans->random();
            Payment::factory()->create([
                'user_id' => $owner->id,
                'plan_id' => $plan->id,
                'amount' => $plan->amount,
            ]);
        });
    }
}
