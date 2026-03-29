<form action="{{ isset($plan) ? route('dashboard.plans.update', $plan) : route('dashboard.plans.store') }}"
    method="POST">
    @csrf
    @isset($plan)
        @method('PUT')
    @endisset
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <x-dashboard-languages-tab>
                        <x-slot:englishContent>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input 
                                    type="text" 
                                    class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" 
                                    id="name" 
                                    name="name_en" 
                                    value="{{ old('name_en', optional($plan??null)->name_en) }}">
                                    @error('name_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea 
                                    class="form-control {{ $errors->has('description_en') ? 'is-invalid' : '' }}" 
                                    id="description_en" 
                                    name="description_en">
                                        {{ old('description_en', optional($plan??null)->description_en) }}
                                </textarea>
                                @error('description_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </x-slot>
                        <x-slot:arabicContent>
                            <div class="mb-3">
                                <label for="name_ar" class="form-label">Name</label>
                                <input 
                                    type="text" 
                                    class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" 
                                    id="name_ar" 
                                    name="name_ar" 
                                    value={{ old('name_ar', optional($plan??null)->name_ar) }}>
                                @error('name_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description_ar" class="form-label">Description</label>
                                <textarea 
                                    class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" 
                                    id="description_ar" 
                                    name="description_ar">
                                        {{ old('description_ar', optional($plan??null)->description_ar) }}
                                </textarea>
                                @error('description_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </x-slot>
                    </x-dashboard-languages-tab>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <label for="price" class="form-label">Price</label>
                        <input 
                            type="text" 
                            class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" 
                            name="amount"
                            value="{{ old('amount', optional($plan ?? null)->amount) }}">
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-dark mt-3">Save</button>
</form>