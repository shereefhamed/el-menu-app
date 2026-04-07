<div class="card mb-3">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Branches</h3>
        <a href="#" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#branchModal">
            <i class="bi bi-plus"></i>
        </a>
    </div>
    <div class="card-body">
        <ul>
            @foreach ($restaurant->branches as $branche)
                {{--  <div class="d-flex gap-1">
                    <input type="text" class="form-control" value="{{ old('address[]', $branche->address) }}" name="address[]">
                    <input type="text" class="form-control" value="{{ old('phone[]', $branche->phone) }}" name="phone[]">
                    <select name="city[]" class="form-control">
                        @foreach ($cities as $city)
                            <option 
                                value="{{ $city->id }}" 
                                {{ $city->id === $branche->city_id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>--}}
                <li class="d-flex border-bottom py-2">
                    <div>
                        <h5>{{ $branche->address }} - <small>{{ $branche->city->name }}</small></h5>
                        <p>{{ $branche->phone }}</p>
                    </div>
                    
                    <span 
                        class="ms-auto" 
                        data-bs-toggle="modal" 
                        data-bs-target="#branchModal" 
                        data-bs-branchId="{{ $branche->id }}"
                        data-bs-cityId="{{ $branche->city_id }}"
                        data-bs-address="{{ $branche->address }}"
                        data-bs-phone="{{ $branche->phone }}"
                        data-bs-cityId="{{ $branche->city_id }}">
                        <i class="bi bi-pencil-fill"></i>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="branchModal" tabindex="-1" aria-labelledby="branchModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="branchModalLabel">Branches</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form action="{{ route('dashboard.restaurants.branches.store', ['restaurant' => $restaurant]) }}" method="POST" id="branches-form">
            @csrf
            <input type="hidden" name="_method" id="methodField" value="POST">
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control address">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone number</label>
                <input type="text" name="phone" class="form-control phone">
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <select name="city_id" id="city" class="form-control city">
                    @foreach ($cities as $city)
                        <option 
                            value="{{ $city->id }}" >
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer d-flex">
            <form 
                id="deleteForm" 
                action="{{ route('dashboard.restaurants.branches.destroy', ['restaurant'=> $restaurant, 'branch' => ":branch"]) }}" method="POST"
                style="display: none;">
                @csrf
                @method('DELETE')
                
            </form>
            <button type="button" class="btn btn-danger" id="delete-branche-btn">Delete</button>
            <div class="ms-auto">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="branch-btn">Save changes</button>
            </div>
      </div>
    </div>
  </div>
</div>

<script>
    const branchModal = document.getElementById('branchModal');
    const branchBtn = document.getElementById('branch-btn');
    const deleteBranchBtn = document.getElementById('delete-branche-btn');
    
    if (branchModal) {
        branchModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget

            const branchId = button.getAttribute('data-bs-branchId');
            const address = button.getAttribute('data-bs-address');
            const phone = button.getAttribute('data-bs-phone');
            const cityId = button.getAttribute('data-bs-cityId');
            const addressInput = branchModal.querySelector('.modal-body .address');
            const phoneInput = branchModal.querySelector('.modal-body .phone');
            const cityInput = branchModal.querySelector('.modal-body .city');
            const form = document.getElementById('branches-form');
            
            const methodField = document.getElementById('methodField');
            console.log(form);
            console.log(address, phone, cityId);
            addressInput.value = '';
            phoneInput.value = '';
            cityInput.value = '';

            form.action = '{{ route('dashboard.restaurants.branches.store', ['restaurant' => $restaurant]) }}';

            methodField.value = 'POST';

            if(address && phone && cityId){
                let url = '{{ route("dashboard.restaurants.branches.update", [ "restaurant" => $restaurant, "branch" => ":branch",]) }}';
                url = url.replace(':branch', branchId);
                
                methodField.value = 'PUT';
                form.action = url;
                addressInput.value = address;
                phoneInput.value = phone;
                cityInput.value = cityId;

                const deleteForm = document.getElementById('deleteForm');
                let deleteUrl = '{{ route('dashboard.restaurants.branches.destroy', ['restaurant'=> $restaurant, 'branch' => ":branch"]) }}';
                deleteUrl =deleteUrl.replace(':branch', branchId);
                deleteForm.action = deleteUrl;

                if(deleteBranchBtn){
                    deleteBranchBtn.addEventListener('click', function(e){
                        deleteForm.submit();
                    });
                }
            }

            if(branchBtn){
                branchBtn.addEventListener('click',function(e){
                    form.submit();
                });
            }
        })
}
</script>