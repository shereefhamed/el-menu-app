<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Currency</h3>
    </div>
    <div class="card-body">
        <div>
            <label for="Currency_id" class="form-label">Currency</label>
            <select name="currency_id" id="currency_id" class="form-control">
                @foreach ($currencies as $currency)
                    <option 
                        value="{{ $currency->id }}" {{ old('currency_id', $restaurant->currency->id) == $currency->id ? 'selected' : ''}}>
                        {{ $currency->symbol }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>