@php
    $selectedAddons = old(
        'addons',
        isset($menuItem) ? $menuItem->addons->pluck('id')->toArray() : []
    );
@endphp
<div class="card mb-3">
    <div class="card-body">
        <div>
            <label for="category_id" class="form-label">Addons</label>
            <select name="addons[]" id="addons" class="form-control" multiple>
                @foreach ($addons as $addon)
                    <option 
                        value="{{ $addon->id }}" 
                        @selected(in_array($addon->id, $selectedAddons))>
                        {{ $addon->name }} - {{ $addon->price }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>