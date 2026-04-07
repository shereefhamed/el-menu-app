<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Info</h3>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $restaurant->name) }}">
        </div>
        <div class="md-3">
            <label for="restaurant_type_id" class="form-label">Food Type</label>
            <select name="restaurant_type_id" id="restaurant_type_id" class="form-control">
                <option>Select food type</option>
                @foreach ($foodTypes as $type)
                    <option value="{{ $type->id }}" {{ $type->id === $restaurant->restaurant_type_id ? 'selected' : '' }}>
                        {{ $type->name_en }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>