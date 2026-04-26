<h4 class="mb-3">{{ __('Order type')}}</h4>
<div class="d-flex gap-3 my-3">
    <div class="form-check"> 
        <input 
            id="dine-in" 
            name="order_type" 
            value="dine_in"
            type="radio" 
            class="form-check-input order-type" 
            required=""
            @checked(old('order_type') === 'dine_in')> 
            <label class="form-check-label" for="credit">{{ __('Dine in') }}</label> 
        </div>
    <div class="form-check"> 
        <input 
            id="delivery" 
            name="order_type" 
            value="delivery"
            type="radio" 
            class="form-check-input order-type" 
            required=""
            @checked(old('order_type') === 'delivery')>
        <label class="form-check-label" for="debit">{{ __('Delivery') }}</label> 
    </div>
    <div class="form-check"> 
        <input 
            id="pickup" 
            name="order_type" 
            value="pickup"
            type="radio" 
            class="form-check-input order-type" 
            required=""
            @checked(old('order_type') === 'pickup')>
        <label class="form-check-label" for="paypal">{{ __('Pickup') }}</label> 
    </div>
</div>