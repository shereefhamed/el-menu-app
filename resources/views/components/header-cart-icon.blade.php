
<div class="header-icon {{ $desktopOnly ? 'desktop-only' : '' }} cart-icon">
    <a href="{{ route('cart.index') }}"><i class="fa-solid fa-basket-shopping"></i></a>

    @if($cartCount > 0)
        <span class="cart-number">{{ $cartCount }}</span>
    @endif
</div>