<?php

namespace App\Http\Controllers\Front;

use App\Contracts\CartInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        protected CartInterface $cart,
    ) {

    }
    public function index()
    {
        $cartItems = $this->cart->items();
        $cartTotal = $this->cart->total();
        $restaurant = $this->cart->restaurant();

        return view(
            'front.cart.index',
            [
                'cartItems' => $cartItems,
                'cartTotal' => $cartTotal,
                'restaurant' => $restaurant,
            ]

        );
    }

    public function addItem(CartRequest $request, ?string $loclae, MenuItem $menuItem)
    {
        $data = $request->validated();
        $result = $this->cart->add($menuItem, $data);
        if (!$result['status']) {
            return back()->with('warning', $result['message']);
        }
        return back()->with('status', 'Menu item added to cart');
    }

    public function update(Request $request)
    {

        $items = request()->input('cart_items');
        $this->cart->update($items);

        return back();
    }

    public function removeItem(string $locale, string $id)
    {
        $this->cart->remove($id);
        return back()->with('success', 'Item removed');
    }
}
