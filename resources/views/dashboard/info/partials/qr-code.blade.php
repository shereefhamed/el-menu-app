<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">QR Code</h3>
    </div>
    <div class="card-body qr-code">
        {!!
            \SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)
            ->generate(route('restaurants.show', ['locale' => app()->getLocale(), 'restaurant' => $restaurant])) 
        !!}
        <a href="{{ route('dashboard.qr.download', ['restaurant' => $restaurant]) }}" class="btn btn-dark my-2">Download</a>
    </div>
</div>