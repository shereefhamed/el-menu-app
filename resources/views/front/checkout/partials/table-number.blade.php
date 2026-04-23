<div class="mb-3 checkout-table-number">
    <label for="table-number" class="form-label">{{ __('Table number') }}</label>
    <input 
        type="number" 
        class="form-control" 
        id="table-number" 
        placeholder="" 
        name="table_number"
        value="{{ old('table_number') }}">
    <div class="invalid-feedback">
        Valid first name is required.
    </div>
</div>