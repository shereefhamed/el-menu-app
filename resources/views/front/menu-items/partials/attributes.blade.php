@if ($menuItem->attributes->isNotEmpty())
    <div class="mb-3">
        <label for="menu-item-attributes" class="form-label">{{ __('Attributes') }}</label>
        <select class="form-select" aria-label="Default select example" id="menu-item-attributes" name="attribute_id">
            <option selected>{{ __('Select item attribute') }}</option>
            @foreach ($menuItem->attributes as $attribute)
                <option 
                    value="{{ $attribute->id }}"
                    data-price="{{ $attribute->pivot->price}}">
                    {{ $attribute->name }}
                    {{ $restaurant->currency->symbol }}{{ $attribute->pivot->price }}
                </option>
            @endforeach
        </select>
    </div>
@endif