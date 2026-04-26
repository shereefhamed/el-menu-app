@if ($menuItem->addons->isNotEmpty())
    <div class="menu-item-addons mb-3">
        <h4>{{ __('Addons') }}</h4>
        @foreach ($menuItem->addons as $addon)
            <div class="form-check">
                <input 
                    class="form-check-input addon" 
                    type="checkbox" 
                    value="{{ $addon->id }}" 
                    name="addons[]"
                    data-price="{{ $addon->price }}">
                <label class="form-check-label" for="addon">
                    {{ $addon->name}} {{ $restaurant->currency->symbol }}{{ $addon->price }}
                </label>
            </div>
        @endforeach
    </div>
@endif