<form
    action="{{ isset($menuItem) ? route('dashboard.menu-items.update', $menuItem) : route('dashboard.menu-items.store') }}"
    enctype="multipart/form-data" method="post">
    @csrf
    @isset($menuItem)
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
                                <input type="text" name="name_en"
                                    value="{{ old('name_en', optional($menuItem ?? null)->name_en) }}"
                                    class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}">
                            </div>
                            <div>
                                <label for="description_en" class="form-label">Description</label>
                                <textarea name="description_en" id="description_en"
                                    class="form-control {{ $errors->has('description_en') ? 'is-invalid' : '' }}">
                                    {{ old('description_en', optional($menuItem ?? null)->description_en) }}
                                </textarea>
                            </div>
                        </x-slot:englishContent>
                        <x-slot:arabicContent>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name_ar"
                                    value="{{ old('name_ar', optional($menuItem ?? null)->name_ar) }}"
                                    class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}">
                            </div>
                            <div>
                                <label for="description_ar" class="form-label">Description</label>
                                <textarea name="description_ar" id="description_ar"
                                    class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}">
                                    {{ old('description_ar', optional($menuItem ?? null)->description_ar) }}
                                </textarea>
                            </div>
                        </x-slot:arabicContent>
                    </x-dashboard-languages-tab>
                </div>
            </div>
            @include('dashboard.menu-items.partials.price')
        </div>
        <div class="col-md-4">
            @include('dashboard.menu-items.partials.image')
            @include('dashboard.menu-items.partials.restaurant')
            @include('dashboard.menu-items.partials.category')
            @include('dashboard.menu-items.partials.addons')
        </div>
    </div>
    <div class="d-flex gap-1">
        <button class="btn btn-dark" type="submit">Save</button>
        @if (isset($menuItem))
            <a href="{{ route('restaurants.menuItems.show', ['locale' => 'en', 'restaurant' => $menuItem->restaurant, 'menuItem' => $menuItem]) }}"
                class="btn btn-outline-dark" target="_blank">View</a>
        @endif
    </div>
</form>