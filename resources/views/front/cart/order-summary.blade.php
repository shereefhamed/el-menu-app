<x-card :title="__('Order summary')">
    <div class="d-flex justify-content-between mb-3">
        <span class="text-muted">Subtotal</span>
        <span>{{ $restaurant->currency->symbol }}{{ $cartTotal }}</span>
    </div>
    <hr>
    <div class="d-flex justify-content-between mb-4">
        <span class="fw-bold">Total</span>
        <span class="fw-bold">{{ $restaurant->currency->symbol }}{{ $cartTotal }}</span>
    </div>
    <button class="btn btn-success checkout-btn w-100 mb-3">
        {{ __('Proceed to Checkout') }}
    </button>
</x-card>