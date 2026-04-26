<div>
    <div class="mb-3 checkout-name-section"> 
        <label for="checkout-name" class="form-label">{{ __('Name') }}</label> 
        <input 
            type="text"
            class="form-control" 
            id="checkout-name"
            placeholder="" 
            value="{{ old('customer_name', auth()->user()->name) }}" 
            name="customer_name">
        <div class="invalid-feedback">
            Valid first name is required.
        </div>
    </div>
    <div class="mb-3 checkout-phone-section"> 
        <label for="checkout-phone" class="form-label">{{ __('Phone') }}</label> 
        <input 
            type="tel"
            class="form-control" 
            id="checkout-phone" 
            placeholder="" 
            value="{{ old('phone', auth()->user()->address?->phone) }}" 
            required=""
            name="phone">
        <div class="invalid-feedback">
            Valid last name is required.
        </div>
    </div>
    <div class="mb-3 checkout-address-section"> 
        <label for="checkout-address" class="form-label">{{ __('Address') }}</label> 
        <input 
            type="text"
            class="form-control" 
            id="checkout-address" 
            placeholder="" 
            value="{{ old('address', auth()->user()->address?->address) }}" 
            name="address">
        <div class="invalid-feedback">
            Valid last name is required.
        </div>
    </div>
    <div class="mb-3 checkout-email-section"> 
        <label for="checkout-email" class="form-label">
            {{ __('Email') }} 
            </label> 
            <input 
                type="email" 
                class="form-control"
                id="checkout-email" 
                placeholder="you@example.com"
                name="email"
                value="{{ old('checkout-email', auth()->user()->email) }}">
        <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
        </div>
    </div>
</div>