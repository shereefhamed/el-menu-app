@php
    $cartData = session()->get('cart', [
        'restaurant' => null,
        'items' => [],
    ]); 
    $cart = $cartData['items'];
@endphp
<div class="header-icon {{ $desktopOnly ? 'desktop-only' : '' }} cart-icon">
    <a href="{{ route('cart.index') }}"><i class="fa-solid fa-basket-shopping"></i></a>

    @if(!empty($cart))
        <span class="cart-number">{{ count($cart) }}</span>
    @endif
</div>