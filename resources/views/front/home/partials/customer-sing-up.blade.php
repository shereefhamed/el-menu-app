<section id="customer-sign-up">
    <div class="container">
        <div class="customer-singup">
            <div class="customer-sinup-text">
                <h3 class="mb-4">{{ __('Signup as a customer') }}</h3>
                <p>{{ __('Signup as a customer and control your cart, favorites, and orders.') }}</p>
                <p>{{ __('Skip the wait — your next favorite meal is just a click away.') }}</p>
                <a href="{{ route('register', ['signup-as' => 'customer']) }}" class="btn btn-success mt-5">
                    {{ __('Signup now') }}
                </a>
            </div>
            <div class="customer-sinup-image" data-aos="zoom-in">
                <img src="{{ asset('images/pizza.png') }}" alt="pizza" >
            </div>
        </div>
    </div>
</section>