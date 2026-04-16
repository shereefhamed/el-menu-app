<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        return view(
            'front.favorites.index',
            
        );
    }

    public function toggleItemToFavorites(string $id)
    {

    }

    public function getItems()
    {
        $ids = explode(',', request()->input('ids'));
        $items = MenuItem::with('restaurant')->whereIn('id', $ids)->get();
        return $items;
    }
}
