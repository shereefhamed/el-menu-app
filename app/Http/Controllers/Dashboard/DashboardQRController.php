<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class DashboardQRController extends Controller
{
    public function download()
    {
        // $qr = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
        // ->size(300)
        // ->generate('https://example.com');
         $qr = \SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)
        ->generate('https://example.com');

    return response($qr)
        ->header('Content-Type', 'image/png')
        ->header('Content-Disposition', 'attachment; filename="qrcode.png"');
    }
}
