<form action="{{isset($addon)?  route('dashboard.addons.update', $addon) : route('dashboard.addons.store') }}" method="POST">
    @csrf
    @isset($addon)
        @method('PUT')
    @endisset
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <x-dashboard-languages-tab>
                        <x-slot:englishContent>
                            <div class="">
                                <label for="name_en" class="form-label">Name</label>
                                <input 
                                    type="text" 
                                    name="name_en"
                                    id="name_en"
                                    class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}"
                                    value="{{ old('name_en', optional($addon??null)->name_en) }}">
                            </div>
                        </x-slot:englishContent>
                        <x-slot:arabicContent>
                            <div class="">
                                <label for="name_ar" class="form-label">Name</label>
                                <input 
                                    type="text" 
                                    name="name_ar"
                                    id="name_en"
                                    class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}"
                                    value="{{ old('name_ar', optional($addon??null)->name_ar) }}">
                            </div>
                        </x-slot:arabicContent>
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
                            type="number"
                            step="0.01"
                            name="price"
                            class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                            value="{{ old('price', optional($addon??null)->price) }}">
                    </div>
                </div>
            </div>
            @can('isAdmin')
                <div class="card mt-3">
                    <div class="card-body">
                        <div>
                            <label for="user_id" class="form-label">User</label>
                            <select name="user_id" id="user_id" class="form-control {{ $errors->has('user_id')? 'is-invalid' : '' }}">
                                <option>Select User</option>
                                @foreach ($users as $user)
                                    <option 
                                        value="{{ $user->id }}" 
                                        {{old('user_id', optional($addon??null)->user_id) == $user->id ? 'selected' : ''  }}>
                                        {{ $user->name }}
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