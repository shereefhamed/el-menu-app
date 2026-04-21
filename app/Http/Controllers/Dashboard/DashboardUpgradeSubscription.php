<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Services\Paymob;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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
        // $reference = 'PLAN-' . $planId . '-' . Str::uuid();
        // $response = Http::withHeaders(
        //     [
        //         'Authorization' => 'Token ' . env('PAYMOB_SECRET_KEY'),
        //         'Content-Type' => 'application/json',
        //     ]
        // )
        //     ->post(
        //         'https://accept.paymob.com/v1/intention/',
        //         [
        //             "amount" => $plan->price * 100,
        //             "currency" => "EGP",
        //             "payment_methods" => [
        //                 (int)env('PAYMOB_ONLINE_CARD_ID')
        //             ],
        //             "items" => [
        //                 [
        //                     "name" => "Item name",
        //                     "amount" => $plan->price * 100,
        //                     "description" => "Item description",
        //                     "quantity" => 1
        //                 ]
        //             ],
        //             "billing_data" => [

        //                 "first_name" => "shereef",
        //                 "last_name" => "hamed",

        //                 "phone_number" => "01008701804",

        //             ],
        //             "extras" => [
        //                 "ee" => 22,
        //                 "plan_id" => 1
        //             ],
        //             "special_reference" => $reference,
        //             "expiration" => 3600,
        //             "notification_url" => "https://webhook.site/dabe4968-5xxxxxxxxxxxxxxxxxxxxxx",
        //             "redirection_url" => route('dashboard.upgrade-subscription.payment-success'),
        //         ]
        //     );
        // if ($response->failed()) {
        //     return back()->with('status', 'Something error, try again later');
        // }
        // $body = $response->json();
        // $clientSecret = $body['client_secret'];


        // $paymob = new Paymob();
        // $paymob = resolve(Paymob::class);
        // $paymob = app(Paymob::class);
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
        // $amount_cents = request()->input('amount_cents');
        // $created_at = request()->input('created_at');
        // $currency = request()->input('currency');
        // $error_occured = request()->input('error_occured');
        // $has_parent_transaction = request()->input('has_parent_transaction');
        // $id = request()->input('id');
        // $integration_id = request()->input('integration_id');
        // $is_3d_secure = request()->input('is_3d_secure');
        // $is_auth = request()->input('is_auth');
        // $is_capture = request()->input('is_capture');
        // $is_refunded = request()->input('is_refunded');
        // $is_standalone_payment = request('is_standalone_payment');
        // $is_voided = request()->input('is_voided');
        // $orderId = request()->input('order');
        // $owner = request()->input('owner');
        // $pending = request()->input('pending');
        // $source_data_pan = request()->input('source_data_pan');
        // $source_data_sub_type = request()->input('source_data_sub_type');
        // $source_data_type = request()->input('source_data_type');
        // $success = request()->input('success');
        // $receivedHmac = request()->input('hmac');
        // $merchant_order_id = request()->input('merchant_order_id');

        // $payload = $amount_cents .
        //     $created_at .
        //     $currency .
        //     $error_occured .
        //     $has_parent_transaction .
        //     $id .
        //     $integration_id .
        //     $is_3d_secure .
        //     $is_auth .
        //     $is_capture .
        //     $is_refunded .
        //     $is_standalone_payment .
        //     $is_voided .
        //     $orderId .
        //     $owner .
        //     $pending .
        //     $source_data_pan .
        //     $source_data_sub_type .
        //     $source_data_type .
        //     $success;

        // $calculatedHmac = hash_hmac('sha512', $payload, env('HMAC'));

        // if (!$receivedHmac || !hash_equals($calculatedHmac, $receivedHmac)) {
        //     return redirect()->route('dashboard.index');

        // }

        // $planId = explode('-', $merchant_order_id)[1];
        // $user = request()->user();
        // $user->payments()->create([
        //     'transaction_id' => $id,
        //     'amount' => $amount_cents / 100,
        //     'plan_id' => $planId,
        // ]);
        // $user->subscription()->update([
        //     'plan_id' => $planId,
        //     'start_at' => now(),
        //     'end_at' => now()->addMonth(),
        // ]);
        // return redirect()->route('dashboard.index')
        //     ->with('status', 'Your plan is upgraded');

        // $paymob = new Paymob();
        // $paymob = app(Paymob::class);
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
