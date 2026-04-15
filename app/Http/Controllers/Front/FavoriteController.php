<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = [];
        return view(
            'front.favorites.index',
            [
                'favorites' => $favorites,
            ]
        );
    }

    public function toggleItemToFavorites(string $id)
    {

    }
}
