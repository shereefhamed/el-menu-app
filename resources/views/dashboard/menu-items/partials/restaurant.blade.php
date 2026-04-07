@can('isAdmin')
    <div class="card mb-3">
        <div class="card-body">
            <div id="restaurant">
                <label for="restaurant_id" class="form-label">Restaurant</label>
                <select name="restaurant_id" id="restaurant_id"
                    class="form-control {{ $errors->has('restaurant_id') ? 'is-invalid' : '' }}">
                    <option>Select Resturant</option>
                    @foreach ($restaurants as $resturant)
                        <option 
                            value="{{ $resturant->id }}" 
                            {{ $resturant->id == old('restaurant_id', optional($menuItem ?? null)->restaurant_id) ? 'selected' : '' }}>
                            {{ $resturant->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
@endcan

