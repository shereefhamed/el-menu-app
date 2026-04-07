<div class="card mb-3">
    <div class="card-body">
        <div>
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id"
                class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                <option>Select category</option>
                @foreach ($categories as $category)
                    <option 
                        value="{{ $category->id }}" 
                        {{ $category->id == old('category_id', optional($menuItem ?? null)->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>