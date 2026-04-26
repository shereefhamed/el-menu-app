@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ __(session('status')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ __(session('warning')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif