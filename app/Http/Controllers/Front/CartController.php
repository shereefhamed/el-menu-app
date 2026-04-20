<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartData = session()->get('cart', [
            'restaurant' => null,
            'items' => [],
        ]);

        $restaurantSlug = $cartData['restaurant'];
        $cart = $cartData['items'];

        $itemIds = collect($cart)->pluck('item_id')->unique()->toArray();


        $menuItems = MenuItem::with(['attributes', 'addons'])
            ->whereIn('id', $itemIds)
            ->get()
            ->keyBy('id');
        $cartTotal = 0;

        $cartItems = collect($cart)
            ->map(
                function ($cartItem, $cartItemId) use ($menuItems, &$cartTotal) {

                    $menuItem = $menuItems[$cartItem['item_id']] ?? null;

                    if (!$menuItem) {
                        return null;
                    }
                    $attribute = $menuItem->attributes
                        ->firstWhere('id', $cartItem['attribute_id']);

                    $addons = $menuItem->addons
                        ->whereIn('id', $cartItem['addons'] ?? []);

                    $basePrice = $attribute ? $attribute->pivot->price : $menuItem->price;

                    $addonsPrice = $addons->sum('price');

                    $unitPrice = $basePrice + $addonsPrice;
                    $total = $unitPrice * $cartItem['quantity'];
                    $cartTotal += $total;
                    return [
                        'cartItemId' => $cartItemId,
                        'menuItem' => $menuItem,
                        'quantity' => $cartItem['quantity'],
                        'attribute' => $attribute,
                        'addons' => $addons,
                        'notes' => $cartItem['notes'] ?? '',
                        'unit_price' => $unitPrice,
                        'total' => $total,
                    ];
                }
            )->filter();
        $restaurant = $restaurantSlug
            ? Restaurant::subscripedRestaturant($restaurantSlug)->with('currency')->first()
            : null;
        return view(
            'front.cart.index',
            [
                'cartItems' => $cartItems,
                'cartTotal' => $cartTotal,
                'restaurant' => $restaurant,
            ]

        );
    }

    public function addItem(Request $request, ?string $loclae, MenuItem $menuItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartData = session()->get('cart', [
            'restaurant' => null,
            'items' => [],
        ]);

        $restaurant = $cartData['restaurant'];
        $cart = $cartData['items'];
        if ($restaurant && $restaurant !== $menuItem->restaurant->slug) {
            return back()->with('status', 'You have items from another restaurant');
        }

        $addons = $request->input('addons') ?? [];
        $attribute_id = $request->input('attribute_id');
        $itemId = $menuItem->id;

        $cartItemId = md5(json_encode([
            $itemId,
            $addons,
            $attribute_id
        ]));

        if (isset($cart[$cartItemId])) {
            $cart[$cartItemId]['quantity'] += request()->input('quantity');
        } else {
            $cart[$cartItemId] = [
                'item_id' => $itemId,
                'quantity' => request()->input('quantity'),
                'addons' => $addons,
                'attribute_id' => $attribute_id,
                'notes' => $request->input('notes'),

            ];
        }

        session()->put('cart', [
            'restaurant' => $menuItem->restaurant->slug,
            'items' => $cart,
        ]);

        return back()->with('status', 'Added to cart');
    }

    public function update(Request $request)
    {
        $cartItems = request()->input('cart_items');
        $cartData = session()->get('cart', [
            'restaurant' => null,
            'items' => [],
        ]);

        $restaurant = $cartData['restaurant'];
        $cart = $cartData['items'];

        foreach ($cartItems as $id => $quantity) {
            if ($quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
            }
        }

        session()->put('cart', [
            'restaurant' => $restaurant,
            'items' => $cart,
        ]);

        return back();
    }

    public function removeItem(string $locale, string $id)
    {
        $cartData = session()->get('cart', [
            'restaurant' => null,
            'items' => [],
        ]);

        $restaurant = $cartData['restaurant'];
        $cart = $cartData['items'];

        unset($cart[$id]);
        if (empty($cart)) {
            $restaurant = null;
        }

        session()->put('cart', [
            'restaurant' => $restaurant,
            'items' => $cart,
        ]);

        return back()->with('success', 'Item removed');
    }
}
