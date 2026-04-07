<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Info</h3>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input 
                type="text" 
                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                name="name" 
                id="name" 
                value="{{ old('name', optional($restaurant??null)->name) }}">
        </div>
        <div class="md-3">
            <label for="restaurant_type_id" class="form-label">Food Type</label>
            <select 
                name="restaurant_type_id" 
                id="restaurant_type_id" 
                class="form-control {{ $errors->has('restaurant_type_id') ? 'is-invalid' : '' }}">
                <option>Select food type</option>
                @foreach ($foodTypes as $type)
                    <option 
                        value="{{ $type->id }}" 
                        @selected($type->id == old('restaurant_type_id', optional($restaurant??null)->restaurant_type_id))>
                        {{ $type->name_en }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>