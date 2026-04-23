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
        <span>Total ({{ $restaurant->currency->symbol }})</span>
        <strong>{{ $cartTotal }}</strong>
    </li>
    <!-- <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
            <h6 class="my-0">Product name</h6> <small class="text-body-secondary">Brief description</small>
        </div> <span class="text-body-secondary">$12</span>
    </li>
    <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
            <h6 class="my-0">Second product</h6> <small class="text-body-secondary">Brief
                description</small>
        </div> <span class="text-body-secondary">$8</span>
    </li>
    <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
            <h6 class="my-0">Third item</h6> <small class="text-body-secondary">Brief description</small>
        </div> <span class="text-body-secondary">$5</span>
    </li>
    <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
        <div class="text-success">
            <h6 class="my-0">Promo code</h6> <small>EXAMPLECODE</small>
        </div> <span class="text-success">−$5</span>
    </li>
    <li class="list-group-item d-flex justify-content-between"> <span>Total (USD)</span>
        <strong>$20</strong>
    </li> -->
</ul>
<!-- <form class="card p-2">
    <div class="input-group"> <input type="text" class="form-control" placeholder="Promo code"> <button type="submit"
            class="btn btn-secondary">Redeem</button> </div>
</form> -->

<hr class="my-4"> 
<button class="w-100 btn btn-success btn-lg" type="submit" id="checkout-submit-btn">
    Continue to checkout
</button>