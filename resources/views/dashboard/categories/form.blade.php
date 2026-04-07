<form
    action="{{ isset($category) ? route('dashboard.categories.update', $category) : route('dashboard.categories.store') }}"
    enctype="multipart/form-data" method="post">
    @csrf
    @isset($category)
        @method('PUT')
    @endisset
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <x-dashboard-languages-tab>
                        <x-slot:englishContent>
                            <div>
                                <label for="name" class="form-label">Name</label>
                                <input 
                                    type="text" 
                                    name="name_en"
                                    value="{{ old('name_en', optional($category ?? null)->name_en) }}"
                                    class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}">
                            </div>
                        </x-slot:englishContent>
                        <x-slot:arabicContent>
                            <div>
                                <label for="name" class="form-label">Name</label>
                                <input 
                                    type="text" 
                                    name="name_ar"
                                    value="{{ old('name_ar', optional($category ?? null)->name_ar) }}"
                                    class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}">
                            </div>
                        </x-slot:arabicContent>
                    </x-dashboard-languages-tab>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    @if (isset($category) && $category->image_url)
                        <img src="{{ $category->thumbnail() }}" alt="{{ $category->name }}" class="img-fluid">
                    @endif
                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Upload category image</label>
                        <input 
                            class="form-control {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}" 
                            type="file" 
                            id="thumbnail" 
                            name="thumbnail">
                    </div>
                </div>
            </div>
            @can('isAdmin')
                <div class="card mb-3">
                    <div class="card-body">
                       
                        <div>
                            <label for="restaurant_id" class="form-label">Restaurant</label>
                            <select 
                                name="restaurant_id" 
                                id="restaurant_id" 
                                class="form-control {{ $errors->has('restaurant_id')? 'is-invalid' : '' }}">
                                <option >Select Resturant</option>
                                @foreach ($restaurants as $resturant)
                                    <option 
                                        value="{{ $resturant->id }}"
                                        {{ $resturant->id == old('restaurant_id', optional($category??null)->restaurant_id) ? 'selected' : '' }}>
                                        {{ $resturant->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
    <button class="btn btn-dark mt-3">Save</button>
</form>