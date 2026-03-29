@extends('layouts.menu')
@section('title', $menuItem->name)
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $menuItem->thumbnail() }}" alt="" class="img-fluid">
            </div>
            <div class="col md-6">
                <form action="">
                    <input type="hidden" name="price" id="final-price-hidden" value="{{ $menuItem->price }}">
                    <h3>{{ $menuItem->name }}</h3>
                    <p>{{ $menuItem->description }}</p>
                    <ul class="menu-item-action-list my-3">
                        <li>{{ __('Category:') }} {{ $menuItem->category->name }}</li>
                        <li>{{ __('Share:') }}</li>
                        <li><a href="#"><i class="fa-regular fa-heart"></i> {{ __('Add To Favorites') }}</a></li>
                        
                    </ul>
                    @if ($menuItem->attributes->isNotEmpty())
                        <div class="mb-3">
                            <label for="menu-item-attributes" class="form-label">{{ __('Attributes') }}</label>
                            <select class="form-select" aria-label="Default select example" id="menu-item-attributes">
                                <option selected>{{ __('Select item attribute') }}</option>
                                @foreach ($menuItem->attributes as $attribute)
                                    <option value="{{ $attribute->pivot->price}}">{{ $attribute->name }}
                                        EGP{{ $attribute->pivot->price }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if ($menuItem->addons->isNotEmpty())
                        <div class="menu-item-addons mb-3">
                            <h4>Addons</h4>
                            @foreach ($menuItem->addons as $addon)
                                <div class="form-check">
                                    <input class="form-check-input addon" type="checkbox" value="{{ $addon->price }}">
                                    <label class="form-check-label" for="addon">
                                        {{ $addon->name}} EGP{{ $addon->price }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <h5 id="menu-item-price"></h5>
                    <div class="add-to-cart-group ">
                        <div class="input-group">
                            <button class="btn btn-outline-secondary" type="button" id="decrease-cart">-</button>
                            <input type="text" class="form-control" value="1" id="cart-quantity">
                            <button class="btn btn-outline-secondary" type="button" id="increase-cart">+</button>
                        </div>
                        <button type="submit" class="btn btn-success add-to-cart-button">{{ __('Add To Cart') }}</button>
                    </div>

                </form>
            </div>
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
            // if (price > 0) {
            //     menuItemPrice.innerHTML = 'EGP' + price

            // }

            // if (menuItemAttributsOptions) {
            //     menuItemAttributsOptions.addEventListener('change', function () {
            //         price = this.value;
            //         menuItemPrice.innerHTML = 'EGP' + price
            //     });
            // }

            // addonCheckboxes.forEach(cb => {
            //     cb.addEventListener('change', () => {
            //         let total = 0;
            //         addonCheckboxes.forEach(item => {
            //             if (item.checked) {
            //                 total += parseFloat(item.value);
            //             }
            //         });

            //         console.log('Total addons price:', total);
            //         menuItemPrice.innerHTML = 'EGP' + (price + total)
            //     });
            // });

            // let base = parseFloat(menuItemAttributsOptions ? menuItemAttributsOptions.value : {{ $menuItem->price }}) || 0;
            // function updateTotalPrice() {
            //     //let base = parseFloat(menuItemAttributsOptions ? menuItemAttributsOptions.value : {{ $menuItem->price }}) || 0;
            //     let addonsTotal = 0;

            //     addonCheckboxes.forEach(item => {
            //         if (item.checked) addonsTotal += parseFloat(item.value);
            //     });

            //     const finalPrice = base + addonsTotal;
            //     menuItemPrice.innerHTML = 'EGP ' + finalPrice.toFixed(2);
            // }

            // if(base> 0){
            //     menuItemPrice.innerHTML = 'EGP ' + base;
            // }

            // // Attach the function to all inputs
            // if (menuItemAttributsOptions) {
            //     menuItemAttributsOptions.addEventListener('change', updateTotalPrice);
            // }

            // addonCheckboxes.forEach(cb => {
            //     cb.addEventListener('change', updateTotalPrice);
            // });


            // if (increaseCartBtn) {
            //     increaseCartBtn.addEventListener('click', function () {
            //         cartQuantity.value = parseInt(cartQuantity.value) + 1;
            //     });
            // }

            // if (decreaseCartBtn) {
            //     decreaseCartBtn.addEventListener('click', function () {
            //         if (parseInt(cartQuantity.value) > 1) {
            //             cartQuantity.value = parseInt(cartQuantity.value) - 1;
            //         }

            //     });
            // }

            // 1. Initial configuration
            const basePriceFromModel = {{ $menuItem->attributes->isNotEmpty() ? 0 : $menuItem->price }};


            function updateTotalPrice() {
                // A. Get Base Price (from Select or default)
                let selectedBase = basePriceFromModel;
                if (menuItemAttributsOptions && menuItemAttributsOptions.value !== "{{ __('Select item attribute') }}") {
                    selectedBase = parseFloat(menuItemAttributsOptions.value);
                }

                // B. Calculate Addons
                let addonsTotal = 0;
                addonCheckboxes.forEach(item => {
                    if (item.checked) {
                        addonsTotal += parseFloat(item.value);
                    }
                });

                // C. Get Quantity
                let qty = parseInt(cartQuantity.value) || 1;

                // D. Final Calculation: (Base + Addons) * Quantity
                const finalTotal = (selectedBase + addonsTotal) * qty;

                // E. Update UI
                menuItemPrice.innerHTML = 'EGP ' + finalTotal.toFixed(2);

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
        <div class="related-items mt-5">
            <h4>Related items</h4>
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach ($related as $menuItem)
                        <div class="swiper-slide">
                            @include('front.menu-items.partials.menu-item-card')
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
    </div>

@endsection