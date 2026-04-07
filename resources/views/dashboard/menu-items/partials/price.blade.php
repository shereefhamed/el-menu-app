<div class="card">
    <div class="card-header">
        <h3 class="card-title">Prices</h3>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="menu-item-types" class="form-label">Menu item type</label>
            <select name="menu-item-types" id="menu-item-types" class="form-control">
                <option 
                    value="simple" 
                    {{ 
                        old(
                            'menu-item-types',
                            isset($menuItem) && $menuItem->attributes->isEmpty() ? 'simple' : ''
                        ) === 'simple' ? 'selected' : '' 
                    }}>
                    Simple
                </option>
                <option 
                    value="variable" 
                    {{ 
                        old(
                            'menu-item-types',
                            isset($menuItem) && $menuItem->attributes->isNotEmpty() ? 'variable' : ''
                        ) === 'variable' ? 'selected' : '' 
                    }}>
                    Variable
                </option>
            </select>
        </div>

        <div class="menu-item-type simple-menu-item">
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input 
                    type="text" 
                    name="price" 
                    class="form-control"
                    value="{{ old('price', isset($menuItem) ? $menuItem->price : '') }}">
            </div>
        </div>


        <div class="menu-item-type variable-menu-item">
            @foreach($attributes as $attribute)
                    <div class="form-check d-flex gap-1 mb-3">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            value="{{ $attribute->id }}" 
                            id="checkChecked"
                            name="attributes[{{ $attribute->id }}][id]" 
                            {{ isset($menuItem) && $menuItem->attributes->contains($attribute->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkChecked">
                            {{ $attribute->name }}
                        </label>
                        <input 
                            type="number" 
                            step="0.01" 
                            class="form-control" 
                            name="attributes[{{ $attribute->id }}][price]"
                            placeholder="Price" 
                            value="{{ 
                                    old(
                                        'attributes.' . $attribute->id . '.price',
                                        isset($menuItem)
                                        ? optional($menuItem->attributes->find($attribute->id))->pivot->price ?? ''
                                        : ''
                                    ) }}">
                    </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function dispayItem(item) {
        const menuItemTypeItems = document.querySelectorAll('.menu-item-type');
        menuItemTypeItems.forEach(item => {
            // item.style.display = 'none';
            const inputs = item.querySelectorAll('input, select, textarea');
            item.hidden = true;
            inputs.forEach(input => input.disabled = true);
        });
        const displayItem = document.querySelector('.' + item + '-menu-item');
        // displayItem.style.display = 'block';
        const inputs = displayItem.querySelectorAll('input, select, textarea');
        displayItem.hidden = false;
        inputs.forEach(input => input.disabled = false);
    }

    const menuItemTypeSelector = document.getElementById('menu-item-types');
    if (menuItemTypeSelector) {
        menuItemTypeSelector.addEventListener('change', function (e) {
            dispayItem(this.value);
        });
    }
    dispayItem(menuItemTypeSelector.value);
</script>