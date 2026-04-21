<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService)
    {

    }
    public function index()
    {

        $cartItems = $this->cartService->getCartMenuItems();
        $cartTotal = $this->cartService->total();
        $restaurant = $this->cartService->getRestaurant();
        

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


        $result = $this->cartService->addItemToCart($menuItem, $request->all());
        if (!$result['status']) {
            return back()->with('status', $result['message']);
        }
        return back()->with('status', 'Added to cart');
    }

    public function update(Request $request)
    {

        $items = request()->input('cart_items');
        $this->cartService->updateCart($items);

        return back();
    }

    public function removeItem(string $locale, string $id)
    {
        
        $this->cartService->removeItemFromCart($id);

        return back()->with('success', 'Item removed');
    }
}
