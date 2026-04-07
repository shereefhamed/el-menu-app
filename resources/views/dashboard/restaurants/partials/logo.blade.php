<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Logo</h3>
    </div>
    <div class="card-body">
        @if (isset($restaurant) && $restaurant->logo)
            <img src="{{ $restaurant->logo() }}" alt="{{ $restaurant->name }}" class="img-fluid">
        @endif
        <div class="mb-3">
            <label for="logo" class="form-label">Upload logo image</label>
            <input class="form-control" type="file" id="logo" name="logo" >
        </div>
    </div>
</div>