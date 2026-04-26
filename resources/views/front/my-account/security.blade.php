<form action="{{ route('password.update') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="current_password" class="form-label">{{ __('Current password') }}</label>
        <input 
            type="password" 
            class="form-control {{ $errors->has('current_password')? 'is-invalid' : '' }}" 
            id="current_password" 
            name="current_password">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">{{ __('New password') }}</label>
        <input 
            type="password" 
            class="form-control {{ $errors->has('password')? 'is-invalid' : '' }}" 
            id="password" 
            name="password">
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
        <input 
            type="password" 
            class="form-control {{ $errors->has('current_password')? 'is-invalid' : '' }}" 
            id="password_confirmation" 
            name="password_confirmation">
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>