<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Owner</h3>
    </div>
    <div class="card-body">
        <div>
            <label for="Currency_id" class="form-label">Owner</label>
            <select 
                name="user_id" 
                id="user_id" 
                class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}">
                <option>Select Owner</option>
                @foreach ($owners as $owner)
                    <option 
                        value="{{ $owner->id }}" 
                        @selected($owner->id == old('user_id', optional($restaurant??null)->user_id))>
                        {{ $owner->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>