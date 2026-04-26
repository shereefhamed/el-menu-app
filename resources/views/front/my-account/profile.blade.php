<form action="{{ route('my-account.update-profile') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input type="text" class="form-control" id="email" name="email" value="{{ old('name', auth()->user()->email) }}">
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>