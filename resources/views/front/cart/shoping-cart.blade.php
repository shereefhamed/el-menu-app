<div class="d-flex justify-content-between align-items-center">
    <h4>{{ __('Shopping cart') }}</h4>
    <span>{{ $cartItems->count() }} {{ __('items') }}</span>
</div>
@foreach ($cartItems as $cartItem)
    <x-card>
        <div class="row align-items-center">
            <div class="col-md-2">
                <div class="cart-item-image">
                    <img src="{{ $cartItem['menuItem']->thumbnail() }}" alt="{{ $cartItem['menuItem']->name }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="cart-item-name">
                    <h6>{{ $cartItem['menuItem']->name }}</h6>
                    @if (isset($cartItem['attribute']))

                        <p><small>{{ $cartItem['attribute']->name }}</small></p>
                    @endif
                    <p>
                        <small>
                            @foreach ($cartItem['addons'] as $addon)
                                {{ $addon->name }} |
                            @endforeach
                        </small>
                    </p>
                    <p><small>{{ $cartItem['notes'] }}</small></p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <button 
                        class="btn btn-outline-secondary decrease-shopping-cart-item" 
                        type="button" 
                        data-item-id="{{ $cartItem['cartItemId']}}">
                        -
                    </button>
                    <input 
                        type="text" 
                        class="form-control" 
                        value="{{ $cartItem['quantity'] }}" 
                        class="shoping-cart-item-quantity"
                        name="quantity"
                        id="cart-item-{{ $cartItem['cartItemId']}}">
                    <button 
                        class="btn btn-outline-secondary increase-shoping-cart-item" 
                        type="button" 
                        data-item-id="{{ $cartItem['cartItemId'] }}">
                        +
                    </button>
                </div>
            </div>
            <div class="col-md-2">
                <h6>{{ $restaurant->currency->symbol }}{{ $cartItem['total'] }}</h6>
            </div>
            <div class="col-md-2">
                <form action="{{ route('cart.remove', ['id' => $cartItem['cartItemId']]) }}" method="POST"
                    class="delete-cart-item-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <span>
                            <i class="fa-regular fa-trash-can"></i>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </x-card>
@endforeach