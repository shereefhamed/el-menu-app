<div class="card mb-3">
    <div class="card-header d-flex">
        <h3 class="card-title">Social media</h3>
        <span class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#socialMediaModal"><i class="bi bi-plus"></i></span>
    </div>
    <div class="card-body">
        <ul>
            @foreach ($restaurant->socialMedia as $media)
                <li class="d-flex border-bottom py-2">
                    {{ $media->name }}
                    <span 
                        class="ms-auto" 
                        data-bs-toggle="modal" 
                        data-bs-target="#socialMediaModal" 
                        data-bs-socialMediaId="{{ $media->id }}"
                        data-bs-socialMediaLink="{{ $media->pivot->url }}">
                        <i class="bi bi-pencil-fill"></i>
                    </span>
                </li>
            @endforeach
        </ul>
        
    </div>
</div>

<div class="modal fade" id="socialMediaModal" tabindex="-1" aria-labelledby="socialMediaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="socialMediaModalLabel">Social media</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="social-media-form" method="POST" action="{{ route('dashbaord.restaurant.social-media.store', ['restaurant'=> $restaurant]) }}">
            @csrf
            <input type="hidden" name="_method" id="socialMediaMethodField" value="POST">
            <div class="mb-3">
            <label for="social_media_id" class="col-form-label">Social media</label>
            <select name="social_media_id" id="social_media_id" class="form-control">
                @foreach ($socialMedia as $social)
                    <option value="{{ $social->id }}">{{ $social->name }}</option>
                @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="url" class="col-form-label">URL</label>
            <input class="form-control" id="url" name="url">
          </div>
        </form>
      </div>
      <div class="modal-footer d-flex">
        <form id="social-form-delete-form" action="" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
        <button type="button" class="btn btn-danger" id="social-media-delete-btn">Delete</button>
        <div class="ms-auto">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="socail-media-submit-btn">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    const socailMediaModal = document.getElementById('socialMediaModal');
    const socialMediaForm = document.getElementById('social-media-form');
    const deleteSocialForm = document.getElementById('social-form-delete-form');
    const submitFormBtn = document.getElementById('socail-media-submit-btn');
    const deleteBtn = document.getElementById('social-media-delete-btn');
    const socailMedaiMethodField = document.getElementById('socialMediaMethodField');
    
    if (socialMediaModal) {
        socialMediaModal.addEventListener('show.bs.modal', event => {

            const button = event.relatedTarget;
            const socialMediaId = button.getAttribute('data-bs-socialMediaId');
            const socialMediaLink = button.getAttribute('data-bs-socialMediaLink');
            const socialMediaIdInput =document.getElementById('social_media_id');
            const socialMediaUrlInput = document.getElementById('url');

            socialMediaIdInput.value = '';
            socialMediaUrlInput.value = '';
            socailMedaiMethodField.value = 'POST';
            socialMediaForm.action = '{{ route('dashbaord.restaurant.social-media.store', ['restaurant'=> $restaurant]) }}';

            if(socialMediaId && socialMediaLink){
                socailMedaiMethodField.value = 'PUT';
                socialMediaIdInput.value = socialMediaId;
                socialMediaUrlInput.value = socialMediaLink;

                let routeUrl = '{{ route('dashbaord.restaurant.social-media.update', ['restaurant' => $restaurant, 'socailMedia' => ':socialMedia']) }}';
                routeUrl = routeUrl.replace(':socialMedia', socialMediaId);
                console.log(routeUrl);
                socialMediaForm.action = routeUrl;


                if(deleteBtn){
                    let deleteRoute = '{{ route('dashbaord.restaurant.social-media.destroy', ['restaurant' => $restaurant, 'socailMedia' => ':socailMedia']) }}';
                    deleteRoute = deleteRoute.replace(':socailMedia', socialMediaId);
                    deleteSocialForm.action = deleteRoute;
                    deleteBtn.addEventListener('click', function(e){
                        deleteSocialForm.submit();
                    });
                }
            }

            if(submitFormBtn){
                submitFormBtn.addEventListener('click',function(e){
                    socialMediaForm.submit();
                });
            }


        });
    }
</script>