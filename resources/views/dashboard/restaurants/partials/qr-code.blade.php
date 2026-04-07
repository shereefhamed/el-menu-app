<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">QR Code</h3>
    </div>
    <div class="card-body qr-code">
        {!!\SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)->generate('https://example.com') !!}
        <a href="{{ route('dashboard.qr.download') }}" class="btn btn-dark my-2">Download</a>
    </div>
</div>