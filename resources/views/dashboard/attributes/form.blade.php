<form
    action="{{ isset($attribute) ? route('dashboard.attributes.update', $attribute) : route('dashboard.attributes.store') }}"
    method="POST">
    @csrf
    @isset($attribute)
        @method('PUT')
    @endisset
    <div class="card">
        <div class="card-body">
            <x-dashboard-languages-tab>
                <x-slot:englishContent>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                            id="name" name="name_en" value="{{ old('name_en', optional($attribute ?? null)->name_en) }}">
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </x-slot>
                    <x-slot:arabicContent>
                        <div class="mb-3">
                            <label for="name_ar" class="form-label">Name</label>
                            <input type="text" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                                id="name_ar" name="name_ar" value={{ old('name_ar', optional($attribute ?? null)->name_ar) }}>
                            @error('name_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </x-slot>
            </x-dashboard-languages-tab>
        </div>
    </div>
    <button class="btn btn-dark mt-3" type="submit">Save</button>
</form>