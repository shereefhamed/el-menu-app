<div class="search-form-container">
    <h3 class="text-white">{{ __('Discover restaurants around you') }}</h3>
    <form action="{{ route('restaurants.index') }}" class="search-form">
        <select name="food_type" id="food_type" class="form-control">
            <option value="0">{{ __('Select food type') }}</option>
            @foreach ($foodTypes as $type)
                <option value="{{ $type->id }}" @selected($type->id == request()->input('food_type'))>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
        <select name="country" id="country" class="form-control">
            <option value="0">{{ __('Select country') }}</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}" @selected($country->id == request()->input('country'))>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
        <select name="city" id="city" class="form-control">
            <option value="0">{{ __('Select city') }}</option>
        </select>
        <button class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i> {{ __('Search') }}</button>
    </form>
</div>


<script>
    const currentLocale = "{{ app()->getLocale() }}";
    const selectdCity = '{{ request()->input('city') }}'
    const country = document.getElementById('country');
    const cityOptions = document.getElementById('city');
    const getCountryCities = (countryId) => {
        fetch(`/en/countries/${countryId}/cities`)
            .then(response => response.json())
            .then(cities => {
                cityOptions.innerHTML = `<option value="0">{{ __('Select city') }}</option>`;
                cities.forEach(city => {
                    const cityName = currentLocale == 'en' ? city.name_en : city.name_ar;
                    const selected = selectdCity == city.id;
                    const option = ` 
                                    <option 
                                        value="${city.id}"
                                        ${selected ? 'selected' : ''}>
                                        ${cityName}
                                    </option>`;
                    cityOptions.innerHTML += option;
                });
            });
    }

    if (country) {
        const countryId = country.value;
        if (countryId > 0) {
            getCountryCities(countryId);
        }
        country.addEventListener('change', function (e) {
            const countryId = this.value;
            if (countryId > 0) {
                getCountryCities(countryId);
            }
        });
    }
</script>