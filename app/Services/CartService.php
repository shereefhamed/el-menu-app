<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\MenuItem;
use App\Models\Restaurant;

class CartService
{
    protected string $cartKey = 'cart';
    protected string $cartItemsKey = 'items';
    protected string $restaurantKey = 'restaurant';

    public function getCartItems()
    {
        return $this->getCartDate()[$this->cartItemsKey];
    }

    public function getCartMenuItems()
    {
        return auth()->check()
            ? $this->getCartItemsFromDatabase()
            : $this->getCartItemsFromSession();
        // $cartItems = $this->getCartItems();
        // $itemIds = collect($cartItems)->pluck('item_id')->unique()->toArray();


        // $menuItems = MenuItem::with(['attributes', 'addons'])
        //     ->whereIn('id', $itemIds)
        //     ->get()
        //     ->keyBy('id');

        // return collect($cartItems)
        //     ->map(
        //         function ($cartItem, $cartItemId) use ($menuItems) {

        //             $menuItem = $menuItems[$cartItem['item_id']] ?? null;

        //             if (!$menuItem) {
        //                 return null;
        //             }
        //             $attribute = $menuItem->attributes
        //                 ->firstWhere('id', $cartItem['attribute_id']);

        //             $addons = $menuItem->addons
        //                 ->whereIn('id', $cartItem['addons'] ?? []);

        //             $basePrice = $attribute ? $attribute->pivot->price : $menuItem->price;

        //             $addonsPrice = $addons->sum('price');

        //             $unitPrice = $basePrice + $addonsPrice;
        //             $total = $unitPrice * $cartItem['quantity'];

        //             return [
        //                 'cartItemId' => $cartItemId,
        //                 'menuItem' => $menuItem,
        //                 'quantity' => $cartItem['quantity'],
        //                 'attribute' => $attribute,
        //                 'addons' => $addons,
        //                 'notes' => $cartItem['notes'] ?? '',
        //                 'unit_price' => $unitPrice,
        //                 'total' => $total,
        //             ];
        //         }
        //     )
        //     ->filter();
    }

    public function getRestaurant()
    {
        $restaurantSlug = $this->getCartDate()[$this->restaurantKey];
        if (!$restaurantSlug) {
            return null;
        }
        return Restaurant::subscripedRestaturant($restaurantSlug)->with('currency')->first();
    }

    public function setCart(array $cartitems, ?string $restaurant)
    {
        session()->put($this->cartKey, [
            $this->restaurantKey => $restaurant,
            $this->cartItemsKey => $cartitems,
        ]);
    }



    public function addItemToCart(MenuItem $menuItem, array $data)
    {
        if (auth()->check()) {
            return $this->addToDatabase($menuItem, $data);

        }
        return $this->addToSession($menuItem, $data);
        // $cartItems = $this->getCartItems();
        // $restaurant = $this->getRestaurant();

        // if ($restaurant && $restaurant->id !== $menuItem->restaurant->id) {
        //     return [
        //         'status' => false,
        //         'message' => 'You have items from another restaurant'
        //     ];
        // }

        // $addons = $data['addons'] ?? [];
        // $attribute_id = ['attribute_id'];
        // $itemId = $menuItem->id;

        // $cartItemId = md5(json_encode([
        //     $itemId,
        //     $addons,
        //     $attribute_id
        // ]));

        // if (isset($cartItems[$cartItemId])) {
        //     $cartItems[$cartItemId]['quantity'] += $data['quantity'];
        // } else {
        //     $cartItems[$cartItemId] = [
        //         'item_id' => $itemId,
        //         'quantity' => $data['quantity'],
        //         'addons' => $addons,
        //         'attribute_id' => $attribute_id,
        //         'notes' => $data['notes'],

        //     ];
        // }
        // $restaurant = $menuItem->restaurant->slug;
        // $this->setCart($cartItems, $restaurant);
        // return [
        //     'status' => true,
        //     'message' => 'item added',
        // ];
    }

    public function updateCart(array $data)
    {
        $cartItems = $this->getCartItems();
        $restaurant = $this->getRestaurant();

        foreach ($data as $id => $quantity) {
            if ($quantity > 0) {
                $cartItems[$id]['quantity'] = $quantity;
            }
        }

        $this->setCart($cartItems, $restaurant->slug);
    }

    public function removeItemFromCart(string $cartItemId)
    {
        $cartItems = $this->getCartItems();
        $restaurant = $this->getRestaurant();
        $restaurantSlug = $restaurant->slug;

        unset($cartItems[$cartItemId]);
        if (empty($cartItems)) {
            $restaurantSlug = null;
        }

        $this->setCart($cartItems, $restaurantSlug);
    }


    public function total(): float|int
    {
        return $this->getCartMenuItems()->sum('total');
    }

    public function count(): int
    {
        return collect($this->getCartMenuItems())->sum('quantity');
    }

    private function addToDatabase(MenuItem $menuItem, array $data)
    {
        $cart = Cart::firstOrCreate(
            ['user_id' => auth()->id()],
            ['restaurant_id' => $menuItem->restaurant_id]
        );

        $item = $cart->cartItems()->create([
            'menu_item_id' => $menuItem->id,
            'attribute_id' => $data['attribute_id'] ?? null,
            'quantity' => $data['quantity'] ?? 1,
            'notes' => $data['notes'] ?? null,
        ]);

        $item->addons()->sync($data['addons'] ?? []);
        return [
            'status' => true,
            'message' => 'item added',
        ];
    }

    private function addToSession(MenuItem $menuItem, array $data)
    {
        $cartItems = $this->getCartItems();
        $restaurant = $this->getRestaurant();

        if ($restaurant && $restaurant->id !== $menuItem->restaurant->id) {
            return [
                'status' => false,
                'message' => 'You have items from another restaurant'
            ];
        }

        $addons = $data['addons'] ?? [];
        $attribute_id = ['attribute_id'];
        $itemId = $menuItem->id;

        $cartItemId = md5(json_encode([
            $itemId,
            $addons,
            $attribute_id
        ]));

        if (isset($cartItems[$cartItemId])) {
            $cartItems[$cartItemId]['quantity'] += $data['quantity'];
        } else {
            $cartItems[$cartItemId] = [
                'item_id' => $itemId,
                'quantity' => $data['quantity'],
                'addons' => $addons,
                'attribute_id' => $attribute_id,
                'notes' => $data['notes'],

            ];
        }
        $restaurant = $menuItem->restaurant->slug;
        $this->setCart($cartItems, $restaurant);
        return [
            'status' => true,
            'message' => 'item added',
        ];
    }

    private function getCartDate()
    {
        $cartData = session()->get($this->cartKey, [
            $this->restaurantKey => null,
            $this->cartItemsKey => [],
        ]);
        return $cartData;
    }

    private function getCartItemsFromSession()
    {
        $cartItems = $this->getCartItems();
        $itemIds = collect($cartItems)->pluck('item_id')->unique()->toArray();


        $menuItems = MenuItem::with(['attributes', 'addons'])
            ->whereIn('id', $itemIds)
            ->get()
            ->keyBy('id');

        return collect($cartItems)
            ->map(
                function ($cartItem, $cartItemId) use ($menuItems) {

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
            )
            ->filter();
    }

    private function getCartItemsFromDatabase()
    {
        $cart = Cart::with([
            'attribute',
            'menuItem.addons',
            'items.addons',
            'items.attribute'
        ])->firstWhere('user_id', auth()->id());

        if (!$cart) {
            return collect();
        }

        return $cart->items->map(function ($item) {

            $menuItem = $item->menuItem;
            $attribute = $item->attribute;
            $addons = $item->addons;

            $basePrice = $attribute
                ? $attribute->pivot->price ?? $attribute->price ?? 0
                : $menuItem->price;

            $addonsPrice = $addons->sum('price');

            $unitPrice = $basePrice + $addonsPrice;
            $total = $unitPrice * $item->quantity;

            return [
                'cartItemId' => $item->id,
                'menuItem' => $menuItem,
                'quantity' => $item->quantity,
                'attribute' => $attribute,
                'addons' => $addons,
                'notes' => $item->notes,
                'unit_price' => $unitPrice,
                'total' => $total,
            ];
        });

    }

}