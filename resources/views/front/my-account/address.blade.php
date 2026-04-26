<form action="{{ route('my-account.update-address') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" value="{{ $address?->address }}" name="address" id="address">
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">{{ __('Phone') }}</label>
        <input type="text" class="form-control" value="{{ $address?->phone }}" name="phone" id="phone">
    </div>
    <div class="mb-3">
        <label for="city" class="form-label">{{ __('City') }}</label>
        <input type="text" class="form-control" value="{{ $address?->city }}" name="city" id="city">
    </div>
    <div class="mb-3">
        <label for="country" class="form-label">{{ __('Country') }}</label>
        <input type="text" class="form-control" value="{{ $address?->country }}" name="country" id="country">
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>