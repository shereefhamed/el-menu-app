<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use \SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Restaurant;


class DashboardQRController extends Controller
{
    public function download(Restaurant $restaurant)
    {
        // $qr = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
        // ->size(300)
        // ->generate('https://example.com');

        $qr = QrCode::format('png')->size(300)
            ->generate(route('restaurants.show', ['locale' => app()->getLocale(), 'restaurant' => $restaurant]));

        return response($qr)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="' . $restaurant->name . '.png"');
    }
}
