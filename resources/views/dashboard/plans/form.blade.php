@php
    $allowedNumber = [
        5,
        10,
        20,
        'unlimited'
    ];
@endphp

<form action="{{ isset($plan) ? route('dashboard.plans.update', $plan) : route('dashboard.plans.store') }}"
    method="POST">
    @csrf
    @isset($plan)
        @method('PUT')
    @endisset
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
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
            <x-card title="Options">
                <div class="mb-3">
                    <label for="create-qr-code">Create Qr code</label>
                    <select name="options[create_qr_code]" id="create-qr-code" class="form-control">
                        <option 
                            value="0"
                            @selected(old('options.create_qr_code', $plan->options['create_qr_code']?? null) == 0)
                            >
                            No
                        </option>
                        <option 
                            value="1"
                            @selected(old('options.create_qr_code', $plan->options['create_qr_code']?? null) == 1)>
                            Yes
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="number-of-categories">Number of categories</label>
                    <select name="options[number_of_categories]" id="number-of-categories" class="form-control">
                        @foreach ($allowedNumber as $number)
                            <option 
                                value="{{ $number }}"
                                @selected(old("options.number_of_categories", $plan->options['number_of_categories'] ?? null) == $number)>
                                {{ $number }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="number-of-items">Number of items</label>
                    <select name="options[number_of_items]" id="number-of-items" class="form-control">
                        @foreach ($allowedNumber as $number)
                            <option 
                                value="{{ $number }}"
                                @selected(old("options.number_of_items", $plan->options['number_of_items'] ?? null) == $number)>
                                {{ $number }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </x-card>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <label for="price" class="form-label">Price</label>
                        <input 
                            type="text" 
                            class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" 
                            name="price"
                            value="{{ old('price', optional($plan ?? null)->price) }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-dark mt-3">Save</button>
</form>