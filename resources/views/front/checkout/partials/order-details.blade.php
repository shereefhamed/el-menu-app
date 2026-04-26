<h4 class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-success">{{ __('Your order') }}</span>
    <span class="badge bg-success rounded-pill">{{ $cartItemsCount }}</span>
</h4>
<ul class="list-group mb-3">
    @foreach ($cartItems as $cartItem)
        <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
                <h6 class="my-0">{{ $cartItem['menuItem']->name }} <small>× {{ $cartItem['quantity'] }}</small></h6>
                @if (isset($cartItem['attribute']))
                    <small class="text-body-secondary">{{ $cartItem['attribute']->name }}</small>
                @endif
                @foreach ($cartItem['addons'] as $addon)
                    <small class="text-body-secondary">{{ $addon->name }}</small> |
                @endforeach
                <small class="text-body-secondary">{{ $cartItem['notes'] }}</small>
            </div>
            <span class="text-body-secondary">{{ $cartItem['total'] }}</span>
        </li>
    @endforeach
    <li class="list-group-item d-flex justify-content-between"> 
        <span>{{ __('Total') }} ({{ $restaurant->currency->symbol }})</span>
        <strong>{{ $cartTotal }}</strong>
    </li>
</ul>


<hr class="my-4"> 
<button class="w-100 btn btn-success btn-lg" type="submit" id="checkout-submit-btn">
    {{ __('Continue to checkout') }}
</button>