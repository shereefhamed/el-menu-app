<div class="card mb-3">
    <div class="card-body">
        @if (isset($menuItem) && $menuItem->image_url)
            <img src="{{ $menuItem->thumbnail() }}" alt="{{ $menuItem->name }}" class="img-fluid">
        @endif
        <div class="mb-3">
            <label for="thumbnail" class="form-label">Upload menu item image</label>
            <input class="form-control {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}" type="file" id="thumbnail"
                name="thumbnail">
        </div>
    </div>
</div>