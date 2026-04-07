<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Currency</h3>
    </div>
    <div class="card-body">
        <div>
            <label for="Currency_id" class="form-label">Currency</label>
            <select 
                name="currency_id" 
                id="currency_id" 
                class="form-control {{ $errors->has('currency_id') ? 'is-invalid' : '' }}">
                <option>Select currency</option>
                @foreach ($currencies as $currency)
                    <option 
                        value="{{ $currency->id }}" 
                        @selected($currency->id == old('currency_id', optional($restaurant??null)->currency_id))>
                        {{ $currency->symbol }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>