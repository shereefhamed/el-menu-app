<?php
namespace App\Services\Cart;

use App\Contracts\CartInterface;
use App\Models\Cart;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Support\Collection;

class DatabaseCartService implements CartInterface
{

    protected function user()
    {
        return auth()->user();
    }

    public function add(MenuItem $menuItem, array $data): array
    {
        $cart = Cart::firstOrCreate(
            ['user_id' => $this->user()->id],
            ['restaurant_id' => $menuItem->restaurant_id]
        );

        $quantity = $data['quantity'] ?? 1;
        $addons = $data['addons'] ?? [];
        $attributeId = $data['attribute_id'] ?? null;
        $menuItemId = $menuItem->id;
        $notes = $data['notes'] ?? null;

        if ($cart->restaurant_id !== $menuItem->restaurant->id) {
            return [
                'status' => false,
                'message' => self::ADDTOCARTERRORMESSAGE,
            ];
        }
        $addonIds = array_values($addons);

        $existingItem = $cart->cartItems()
            ->where('menu_item_id', $menuItemId)
            ->where('attribute_id', $attributeId)
            ->whereHas('addons', function ($q) use ($addonIds) {
                $q->whereIn('addon_id', $addonIds);
            }, '=', count($addonIds))
            ->whereDoesntHave('addons', function ($q) use ($addonIds) {
                $q->whereNotIn('addon_id', $addonIds);
            })
            ->first();

        if ($existingItem) {
            $existingItem->increment('quantity', $quantity);

            return [
                'status' => true,
                'message' => 'Quantity updated',
            ];
        }

        $item = $cart->cartItems()->create([
            'menu_item_id' => $menuItemId,
            'attribute_id' => $attributeId,
            'quantity' => $quantity,
            'notes' => $notes,
        ]);

        $item->addons()->sync($addons);
        return [
            'status' => true,
            'message' => 'item added',
        ];
    }

    public function items(): Collection
    {
        // $cart = Cart::with([
        //     'cartItems',
        //     'cartItems.menuItem',
        //     'cartItems.addons',
        //     'cartItems.attribute'
        // ])
        //     ->firstWhere('user_id', $this->user()->id);

        $cart = auth()->user()->cart()->with([
            'cartItems',
            'cartItems.menuItem',
            'cartItems.addons',
            'cartItems.attribute'
        ])->first();



        if (!$cart) {
            return collect();
        }


        return $cart->cartItems->map(function ($cartItem) {

            $menuItem = $cartItem->menuItem;
            $quantity = $cartItem->quantity;
            $notes = $cartItem->notes;
            $attribute = $menuItem->attributes
                ->firstWhere('id', $cartItem->attribute_id);
            $addons = $cartItem->addons;

            $basePrice = $attribute
                ? $attribute->pivot->price
                : $menuItem->price;

            $addonsPrice = $addons->sum('price');

            $unitPrice = $basePrice + $addonsPrice;
            $total = $unitPrice * $quantity;

            return [
                'cartItemId' => $cartItem->id,
                'menuItem' => $menuItem,
                'quantity' => $quantity,
                'attribute' => $attribute,
                'addons' => $addons,
                'notes' => $notes,
                'unit_price' => $unitPrice,
                'total' => $total,
            ];
        });
    }

    public function total(): float|int
    {

        return $this->items()->sum('total');
    }

    public function count(): int
    {
        $cart = Cart::with('cartItems')->firstWhere('user_id', $this->user()->id);
        return $cart
            ? $cart->cartItems->sum('quantity')
            : 0;
    }

    public function remove(string|int $id): void
    {
        $this->user()->cart?->cartItems()->whereKey($id)->delete();
        if ($this->user()?->cart->cartItems()->count() === 0) {
            $this->user()?->cart()->delete();
        }
    }

    public function clear(): void
    {
        $this->user()?->cart?->cartItems()->delete();
        $this->user()?->cart()->delete();
    }

    public function restaurant(): Restaurant|null
    {
        $cart = Cart::with(['restaurant', 'restaurant.currency'])->firstWhere('user_id', auth()->id());

        return $cart?->restaurant;
    }

    public function update(array $data): void
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        foreach ($data as $cartItemId => $quantity) {

            $quantity = (int) $quantity;

            if ($quantity < 1) {
                $quantity = 1;
            }

            $cart->cartItems()
                ->where('id', $cartItemId)
                ->update([
                    'quantity' => $quantity
                ]);
        }
    }
}