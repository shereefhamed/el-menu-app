<form
    action="{{isset($media) ? route('dashboard.social-media.update', $media) : route('dashboard.social-media.store') }}"
    method="POST">
    @csrf
    @isset($media)
        @method('PUT')
    @endisset
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name"
                    value="{{ old('name', optional($media?? null)->name) }}">
            </div>
            <div class="mb-3">
                <label for="icon" class="form-label">Icon</label>
                <select name="icon" id="icon" class="form-control">
                    <option>Select icon</option>
                    @foreach ($icons as $icon)
                        <option value="{{ $icon['icon'] }}" {{ old('icon', optional($media?? null)->icon === $icon['icon'])? 'selected' : '' }}>{{ $icon['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <button class="btn btn-dark mt-3">Save</button>
</form>