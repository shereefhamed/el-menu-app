<?php
namespace App\Services\Cart;

use App\Contracts\CartInterface;
use App\Models\Cart;
use App\Models\MenuItem;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Collection;

class SessionCartService implements CartInterface
{
    protected string $cartKey = 'cart';
    protected string $cartItemsKey = 'items';
    protected string $restaurantKey = 'restaurant';

    private function getCartDate()
    {
        $cartData = session()->get($this->cartKey, [
            $this->restaurantKey => null,
            $this->cartItemsKey => [],
        ]);
        return $cartData;
    }
    protected function getCartItems()
    {
        return $this->getCartDate()[$this->cartItemsKey];
    }

    public function restaurant(): Restaurant|null
    {
        $restaurantSlug = $this->getCartDate()[$this->restaurantKey];
        if (!$restaurantSlug) {
            return null;
        }
        return Restaurant::subscripedRestaturant($restaurantSlug)->with('currency')->first();
    }

    protected function setCart(array $cartitems, ?string $restaurant)
    {
        session()->put($this->cartKey, [
            $this->restaurantKey => $restaurant,
            $this->cartItemsKey => $cartitems,
        ]);
    }
    public function add(MenuItem $menuItem, array $data): array
    {
        $cartItems = $this->getCartItems();
        $restaurant = $this->restaurant();

        if ($restaurant && $restaurant->id !== $menuItem->restaurant->id) {
            return [
                'status' => false,
                'message' => self::ADDTOCARTERRORMESSAGE,
            ];
        }

        $quantity = $data['quantity'] ?? 1;
        $addons = $data['addons'] ?? [];
        $attribute_id = $data['attribute_id'] ?? null;
        $menuItemId = $menuItem->id;
        $notes = $data['notes']?? '';

        $cartItemId = md5(json_encode([
            $menuItemId,
            $addons,
            $attribute_id
        ]));


        if (isset($cartItems[$cartItemId])) {
            $cartItems[$cartItemId]['quantity'] += $quantity;
        } else {
            $cartItems[$cartItemId] = [
                'menu_item_id' => $menuItemId,
                'quantity' => $quantity,
                'addons' => $addons,
                'attribute_id' => $attribute_id,
                'notes' => $notes,

            ];
        }
        $restaurant = $menuItem->restaurant->slug;
        $this->setCart($cartItems, $restaurant);
        return [
            'status' => true,
            'message' => 'item added',
        ];
    }

    public function items(): Collection
    {
        $cart = $this->getCartItems();

        $cartitemIds = collect($cart)->pluck('menu_item_id')->unique()->toArray();

        $menuItems = MenuItem::with(['attributes', 'addons'])
            ->whereIn('id', $cartitemIds)
            ->get()
            ->keyBy('id');

        return collect($cart)
            ->map(fn($cartItem, $cartItemId) => $this->transformRow($cartItem, $cartItemId, $menuItems))
            ->filter();
    }

    protected function transformRow(array $cartItem, string $cartItemId, $menuItems): ?array
    {
        $quantity = $cartItem['quantity'];
        $menuItemId = $cartItem['menu_item_id'];
        $attributeId = $cartItem['attribute_id'] ?? null;
        $addons = $cartItem['addons'] ?? [];
        $notes = $cartItem['notes'] ?? '';
        $menuItem = $menuItems[$menuItemId] ?? null;

        if (!$menuItem) {
            return null;
        }

        $attribute = $menuItem->attributes
            ->firstWhere('id', $attributeId);

        $addons = $menuItem->addons
            ->whereIn('id', $addons);

        $basePrice = $attribute
            ?
            $attribute->pivot->price
            : $menuItem->price;

        $addonsPrice = $addons->sum('price');

        $unitPrice = $basePrice + $addonsPrice;
        $total = $unitPrice * $quantity;

        return [
            'cartItemId' => $cartItemId,
            'menuItem' => $menuItem,
            'quantity' => $quantity,
            'attribute' => $attribute,
            'addons' => $addons,
            'notes' => $notes,
            'unit_price' => $unitPrice,
            'total' => $total,
        ];
    }

    public function total(): float|int
    {
        return $this->items()->sum('total');
    }

    public function count(): int
    {
        return collect($this->items())->sum('quantity');
    }

    public function remove(string|int $id): void
    {
        $cartItems = $this->getCartItems();
        $restaurant = $this->restaurant();
        $restaurantSlug = $restaurant->slug;

        unset($cartItems[$id]);
        if (empty($cartItems)) {
            $restaurantSlug = null;
        }

        $this->setCart($cartItems, $restaurantSlug);
    }

    public function clear(): void
    {
        session()->forget($this->cartKey);
    }

    public function update(array $data): void
    {
        $cartItems = $this->getCartItems();
        $restaurant = $this->restaurant();

        foreach ($data as $id => $quantity) {
            if ($quantity > 0) {
                $cartItems[$id]['quantity'] = $quantity;
            }
        }

        $this->setCart($cartItems, $restaurant->slug);
    }

    public function mergeGuestCartToUser(User $user)
    {
        
        $cartItems = $this->getCartItems();
        $restaurant = $this->restaurant();

        if (empty($cartItems)) {
            return;
        }

        $cart = Cart::firstWhere([
            'user_id' => $user->id,
        ]);

        if(!$cart){
            $cart =Cart::create([
                'user_id' => $user->id,
                'restaurant_id' => $restaurant->id,
            ]);
        }else {
            $cart->cartItems()->delete();

            if($cart->restaurant_id !== $restaurant->id){
                $cart->update([
                    'restaurant_id' => $restaurant->id,
                ]);
             }

        }

        foreach ($cartItems as $carItem) {
                $menuItemId = $carItem['menu_item_id'];
                $attributeId = $carItem['attribute_id'] ?? null;
                $quantity = $carItem['quantity']?? 1;
                $addons = $carItem['addons']?? [];
                $notes = $carItem['notes'] ?? null;

                $newItem = $cart->cartItems()->create([
                    'menu_item_id' => $menuItemId,
                    'attribute_id' => $attributeId,
                    'quantity' => $quantity,
                    'notes' => $notes,
             
                ]);

                $newItem->addons()->attach($addons);
        }

        $this->clear();
    }
}