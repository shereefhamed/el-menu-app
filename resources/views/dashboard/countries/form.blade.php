<form action=" {{isset($country) ? route('dashboard.countries.update', $country) : route('dashboard.countries.store') }}"
    method="POST">
    @csrf
    @if (isset($country))
        @method('PUT')
    @endif
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="en-tab" data-bs-toggle="tab" data-bs-target="#en-tab-pane" type="button"
                role="tab" aria-controls="en-tab-pane" aria-selected="true">English</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ar_tab" data-bs-toggle="tab" data-bs-target="#ar_tab-pane" type="button"
                role="tab" aria-controls="ar_tab-pane" aria-selected="false">Arabic</button>
        </li>

    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="en-tab-pane" role="tabpanel" aria-labelledby="en-tab" tabindex="0">
            <div class="mb-3">
                <label for="name_en" class="form-label">Name(English)</label>
                <input type="text" class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" id="name_en"
                    name="name_en" value="{{ old('name_en', optional($country ?? null)->name_en) }}">
                @error('name_en')
                    <div class="invalid-feedback">{{ $message }} </div>
                @enderror
            </div>
        </div>
        <div class="tab-pane fade" id="ar_tab-pane" role="tabpanel" aria-labelledby="ar_tab" tabindex="0">
            <div class="mb-3">
                <label for="name_ar" class="form-label">Name(Arabic)</label>
                <input type="text" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" id="name_ar"
                    name="name_ar" value="{{ old('name_ar', optional($country??null)->name_ar) }}">
                @error('name_ar')
                    <div class="invalid-feedback">{{ $message }} </div>
                @enderror
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-dark">Save</button>
</form>