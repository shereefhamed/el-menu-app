<?php

namespace App\Http\Controllers\Front;

use App\Contracts\CartInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Notifications\NewOrderForOwner;
use App\Notifications\OrderPlaced;
use Illuminate\Support\Facades\Notification;

class CheckoutController extends Controller
{
    public function __construct(public CartInterface $cart)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $cartItems = $this->cart->items();
        $cartTotal = $this->cart->total();
        $restaurant = $this->cart->restaurant();
        $cartItemsCount = $this->cart->count();
        return view(
            'front.checkout.index',
            [
                'cartItems' => $cartItems,
                'cartTotal' => $cartTotal,
                'restaurant' => $restaurant,
                'cartItemsCount' => $cartItemsCount
            ]
        );
    }

    public function store(CheckoutRequest $request)
    {
        $data = $request->validated();
        if ($this->cart->count() === 0) {
            return back()->with('status', 'Your cart is empty');
        }
        $currentUser = auth()->user();
        $cartTotal = $this->cart->total();
        $serviceFee = 0;
        $deliveryFee = 0;
        $restaurant = $this->cart->restaurant();
        $owner = $restaurant->user;
        $data['restaurant_id'] = $restaurant->id;
        $data['delivery_fee'] = $deliveryFee;
        $data['service_fee'] = $serviceFee;
        $data['subtotal'] = $cartTotal;
        $data['total'] = $cartTotal + $serviceFee + $deliveryFee;

        $order = $currentUser->orders()->create($data);

        $currentUser->address()->updateOrCreate(
            [],
            [
                'phone' => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
                'city' => $data['city'] ?? null,
                'country' => $data['counrty'] ?? null,
            ]
        );

        $cartItems = $this->cart->items();
        foreach ($cartItems as $cartItem) {
            $quantity = $cartItem['quantity'] ?? 1;
            $menuItemId = $cartItem['menuItem']->id;
            $itemName = $cartItem['menuItem']->name;
            $unitPrice = $cartItem['unit_price'];
            $total = $cartItem['total'];

            $addons = $cartItem['addons']->map(function ($addon) {
                return [
                    'id' => $addon->id,
                    'name' => $addon->name,
                    'price' => $addon->price,
                ];
            })->values();
            $attribute = $cartItem['attribute']
                ? [
                    'id' => $cartItem['attribute']->id,
                    'name' => $cartItem['attribute']->name,
                    'price' => $cartItem['attribute']->pivot->price,
                ]
                : null;
            $notes = $cartItem['notes'] ?? null;

            $order->orderItems()->create([
                'quantity' => $quantity,
                'menu_item_id' => $menuItemId,
                'item_name' => $itemName,
                // 'base_price' => $basePrice,
                'unit_price' => $unitPrice,
                'total' => $total,
                'addons' => $addons,
                'attribute' => $attribute,
                'notes' => $notes
            ]);
        }

        // Notification::send($currentUser, new OrderPlaced($order));
        // $currentUser->notify(new OrderPlaced($order));
        // $owner->notify(new NewOrderForOwner($order));

        $this->cart->clear();
        return redirect()->route('checkout.thankyou', ['orderId' => $order->orderId()]);

    }

    public function thankYou(?string $loclae, string $orderId)
    {
        $order = Order::orderByOrderId($orderId)->with(['orderItems.menuItem',])->firstOrFail();
        abort_if($order->user_id !== auth()->user()->id, 404);
        return view(
            'front.checkout.thank-you',
            ['order' => $order]
        );
    }
}
