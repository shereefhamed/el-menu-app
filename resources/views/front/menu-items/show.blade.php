@extends('layouts.menu.menu')
@section('title', $menuItem->name)
@section('content')
    <div class="container my-5">
       <x-errors />
        <x-alert />
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $menuItem->thumbnail() }}" alt="" class="img-fluid">
            </div>
            <div class="col md-6">
                <form action="{{ route('cart.add', ['menuItem' => $menuItem]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="price" id="final-price-hidden" value="{{ $menuItem->price }}">
                    <h3>{{ $menuItem->name }}</h3>
                    <p>{{ $menuItem->description }}</p>
                    <ul class="menu-item-action-list my-3">
                        <li>{{ __('Category:') }} {{ $menuItem->category->name }}</li>
                        <li>{{ __('Share:') }}</li>
                        <li>
                            <a href="#" class="favorite-btn" data-id="{{ $menuItem->id }}">
                                <i class="fa-regular fa-heart"></i>

                            </a>
                            {{ __('Add To Favorites') }}
                        </li>

                    </ul>
                    @include('front.menu-items.partials.attributes')
                    @include('front.menu-items.partials.addons')
                    <h5 id="menu-item-price"></h5>
                    <div class="mb-3">
                        <label for="notes" class="notes" class="form-label">{{ __('Notes') }}</label>
                        <textarea name="notes" id="notes" placeholder="{{ __('Add your notes') }}" class="form-control"></textarea>
                    </div>
                    <div class="add-to-cart-group ">
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" id="decrease-cart">-</button>
                            <input type="text" class="form-control" value="1" id="cart-quantity" name="quantity">
                            <button class="btn btn-outline-secondary" type="button" id="increase-cart">+</button>
                        </div>
                        <button type="submit" class="btn btn-success add-to-cart-button">{{ __('Add To Cart') }}</button>
                    </div>

                </form>
            </div>
        </div>
        @include('front.menu-items.partials.related-items')
    </div>
    <script>
        // let price = {{$menuItem->attributes->isNotEmpty() ? 0 : $menuItem->price}};

        const menuItemAttributsOptions = document.getElementById('menu-item-attributes');
        const menuItemPrice = document.getElementById('menu-item-price');
        const addonCheckboxes = document.querySelectorAll('.addon');
        const increaseCartBtn = document.getElementById('increase-cart');
        const decreaseCartBtn = document.getElementById('decrease-cart');
        const cartQuantity = document.getElementById('cart-quantity');
        const hiddenPriceInput = document.getElementById('final-price-hidden');

        const basePriceFromModel = {{ $menuItem->attributes->isNotEmpty() ? 0 : $menuItem->price }};


        function updateTotalPrice() {
            // A. Get Base Price (from Select or default)
            let selectedBase = basePriceFromModel;

            


            if (menuItemAttributsOptions && menuItemAttributsOptions.value !== "{{ __('Select item attribute') }}") {
                let selectedOption =
                menuItemAttributsOptions.options[menuItemAttributsOptions.selectedIndex];

                selectedBase = parseFloat(selectedOption.dataset.price || 0);
                //parseFloat(menuItemAttributsOptions.value);
            }

            // B. Calculate Addons
            let addonsTotal = 0;
            addonCheckboxes.forEach(item => {
                if (item.checked) {
                    const price = parseFloat(item.dataset.price);
                    addonsTotal += price;
                }
            });
            console.log(addonsTotal);



            // C. Get Quantity
            let qty = parseInt(cartQuantity.value) || 1;

            // D. Final Calculation: (Base + Addons) * Quantity
            const finalTotal = (selectedBase + addonsTotal) * qty;

            // E. Update UI
            menuItemPrice.innerHTML = '{{ $restaurant->currency->symbol }} ' + finalTotal.toFixed(2);

            if (hiddenPriceInput) {
                hiddenPriceInput.value = finalTotal.toFixed(2);
            }
        }

        // 2. Attach Listeners
        if (menuItemAttributsOptions) {
            menuItemAttributsOptions.addEventListener('change', updateTotalPrice);
        }

        addonCheckboxes.forEach(cb => {
            cb.addEventListener('change', updateTotalPrice);
        });

        // 3. Update Quantity Listeners
        if (increaseCartBtn) {
            increaseCartBtn.addEventListener('click', function () {
                cartQuantity.value = parseInt(cartQuantity.value) + 1;
                updateTotalPrice(); // Recalculate!
            });
        }

        if (decreaseCartBtn) {
            decreaseCartBtn.addEventListener('click', function () {
                if (parseInt(cartQuantity.value) > 1) {
                    cartQuantity.value = parseInt(cartQuantity.value) - 1;
                    updateTotalPrice(); // Recalculate!
                }
            });
        }

        // 4. Initial Run
        updateTotalPrice();

    </script>
@endsection