<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class Paymob
{
    public function __construct(public string $secretKey, public string $onlineCardId,public string $hmacKey) {
       
    }

    public function createIntention(string $planId, float $price, string $itemName)
    {

        $user = Auth::user();
        $reference = 'PLAN-' . $planId . '-' . Str::uuid();
        $response = Http::withHeaders(
            [
                'Authorization' => 'Token ' . $this->secretKey,
                'Content-Type' => 'application/json',
            ]
        )
            ->post(
                'https://accept.paymob.com/v1/intention/',
                [
                    "amount" => $this->amountToCents($price),
                    "currency" => "EGP",
                    "payment_methods" => [
                        (int) $this->onlineCardId
                    ],
                    "items" => [
                        [
                            "name" => $itemName,
                            "amount" => $this->amountToCents($price),
                            "description" => "Plan Subscription",
                            "quantity" => 1
                        ]
                    ],
                    "billing_data" => [
                        "first_name" => $user->name,
                        "last_name" => $user->name,
                        "email" => $user->email,
                        "phone_number" => "+92345xxxxxxxx",
                    ],
                    "extras" => [
                        "ee" => 22,
                        "plan_id" => 1
                    ],
                    "special_reference" => $reference,
                    "expiration" => 3600,
                    "notification_url" => "https://webhook.site/dabe4968-5xxxxxxxxxxxxxxxxxxxxxx",
                    "redirection_url" => route('dashboard.upgrade-subscription.payment-success'),
                ]
            );

        abort_if($response->failed(), 404, 'Something error, try again later');

        $body = $response->json();

        $clientSecret = $body['client_secret'];
        return $clientSecret;
    }

    public function processPayment()
    {
        $amount_cents = request()->input('amount_cents');
        $created_at = request()->input('created_at');
        $currency = request()->input('currency');
        $error_occured = request()->input('error_occured');
        $has_parent_transaction = request()->input('has_parent_transaction');
        $id = request()->input('id');
        $integration_id = request()->input('integration_id');
        $is_3d_secure = request()->input('is_3d_secure');
        $is_auth = request()->input('is_auth');
        $is_capture = request()->input('is_capture');
        $is_refunded = request()->input('is_refunded');
        $is_standalone_payment = request('is_standalone_payment');
        $is_voided = request()->input('is_voided');
        $orderId = request()->input('order');
        $owner = request()->input('owner');
        $pending = request()->input('pending');
        $source_data_pan = request()->input('source_data_pan');
        $source_data_sub_type = request()->input('source_data_sub_type');
        $source_data_type = request()->input('source_data_type');
        $success = request()->input('success');
        $receivedHmac = request()->input('hmac');
        $merchant_order_id = request()->input('merchant_order_id');

        $payload = $amount_cents .
            $created_at .
            $currency .
            $error_occured .
            $has_parent_transaction .
            $id .
            $integration_id .
            $is_3d_secure .
            $is_auth .
            $is_capture .
            $is_refunded .
            $is_standalone_payment .
            $is_voided .
            $orderId .
            $owner .
            $pending .
            $source_data_pan .
            $source_data_sub_type .
            $source_data_type .
            $success;

        $calculatedHmac = hash_hmac('sha512', $payload, $this->hmacKey);

        if (!$receivedHmac || !hash_equals($calculatedHmac, $receivedHmac)) {
            return [
                'status' => false,
                'message' => 'Payment faild',
            ];

        }

        $orderId = explode('-', $merchant_order_id)[1];

        return [
            'status' => true,
            'message' => 'Payment success',
            'order_id' => $orderId,
            'amount' => $amount_cents / 100,
            'transactionId' => $id,

        ];
    }

    private function amountToCents(float $amount)
    {
        return $amount * 100;
    }
}