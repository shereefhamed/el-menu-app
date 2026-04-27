<x-card title="Fees">
    <div class="mb-3">
        <label for="delivery_fee" class="form-label">Delivery fee</label>
        <input type="number" step="0.1" class="form-control"
            value="{{ old('delivery_fee', $restaurant->delivery_fee ?? 0) }}" name="delivery_fee" min="0">
    </div>
    <!-- <div class="mb-3">
        <label for="service_fee" class="form-label">Service fee</label>
        <input type="number" step="0.1" class="form-control"
            value="{{ old('service_fee', $restaurant->service_fee ?? 0) }}" name="service_fee">
    </div> -->
    <label for="service_fee" class="form-label">Service fee</label>
    <div class="input-group mb-3">
        
        <input type="number" step="0.1" class="form-control" min="0"
            value="{{ old('service_fee', $restaurant->service_fee ?? 0) }}" name="service_fee">
        <span class="input-group-text" id="service_fee">%</span>
    </div>
</x-card>