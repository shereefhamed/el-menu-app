<?php

namespace App\View\Components;

use App\Services\CartService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeaderCartIcon extends Component
{
    public int $cartCount;
    /**
     * Create a new component instance.
     */
    public function __construct(public CartService $cartService, public ?bool $desktopOnly=null)
    {
        $this->cartCount = $cartService->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header-cart-icon');
    }
}
