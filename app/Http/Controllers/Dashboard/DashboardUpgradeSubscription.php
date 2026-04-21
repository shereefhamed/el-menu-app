<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Services\Paymob;


class DashboardUpgradeSubscription extends Controller
{
    public function __construct(private Paymob $paymob)
    {

    }
    public function index()
    {
        $plans = Plan::paid()->get();
        return view(
            'dashboard.upgrade-subscription.index',
            [
                'plans' => $plans,
            ]
        );
    }

    public function subscripe(string $planId)
    {

        $plan = Plan::findOrFail($planId);
        $clientSecret = $this->paymob->createIntention($plan->id, $plan->price, $plan->name);

        return view(
            'dashboard.upgrade-subscription.subscripe',
            [
                'clientSecret' => $clientSecret,
            ]
        );
    }

    public function paymentSuccess()
    {
        $result = $this->paymob->processPayment();
        if (!$result['status']) {
            return redirect()->route('dashboard.index');
        }
        $planId = $result['order_id'];
        $transactionId = $result['transactionId'];
        $amount = $result['amount'];

        $user = request()->user();
        $user->payments()->create([
            'transaction_id' => $transactionId,
            'amount' => $amount,
            'plan_id' => $planId,
        ]);
        $user->subscription()->update([
            'plan_id' => $planId,
            'start_at' => now(),
            'end_at' => now()->addMonth(),
        ]);
        return redirect()->route('dashboard.index')
            ->with('status', 'Your plan is upgraded');

    }
}
