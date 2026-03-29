<form action="{{ isset($city) ? route('dashboard.cities.update', $city) : route('dashboard.cities.store') }}"
    method="POST">
    @csrf
    @isset($city)
        @method('PUT')
    @endisset
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="english-name" data-bs-toggle="tab"
                                data-bs-target="#english-name-pane" type="button" role="tab"
                                aria-controls="english-name-pane" aria-selected="true">English</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="arabic" data-bs-toggle="tab" data-bs-target="#arabic-pane"
                                type="button" role="tab" aria-controls="arabic-pane"
                                aria-selected="false">Arabic</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="english-name-pane" role="tabpanel"
                            aria-labelledby="english-name" tabindex="0">
                            <div>
                                <label for="name-arabic" class="form-label">Name</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                                    id="name-arabic" name="name_en"
                                    value="{{ old('name_en', optional($city ?? null)->name_en) }}">
                                @error('name_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="tab-pane fade" id="arabic-pane" role="tabpanel" aria-labelledby="english-name"
                            tabindex="0">
                            <div>
                                <label for="name-arabic" class="form-label">Name</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                                    id="name-arabic" name="name_ar"
                                    value="{{ old('name_ar', optional($city ?? null)->name_ar) }}">
                                @error('name_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select {{ $errors->has('country_id') ? 'is-invalid' : '' }}"
                            name="country_id">
                            <option>Select country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id', optional($city ?? null)->country->id) === $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-dark mt-3">Save</button>
</form>