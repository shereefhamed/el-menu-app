<?php

use App\Http\Controllers\ProfileController;
use App\Models\MenuItem;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     //return view('welcome');
//     // $users = User::whereHas('role', function($query){
//     //     $query->where('role', 'admin');
//     // })->get();

//     // $users = User::with('role')->get();
//     // dd($users);

//     // $users = App\Models\User::with([
//     //     'role' => fn($query) => $query->where('role', 'owner')
//     // ])->get();
//     // dd($users);

//     // $owners = User::whereHas('role', function ($query) {
//     //     $query->where('name', 'owner');
//     // })->get();
//     // dd($owners);
//     // $restaurant = Restaurant::with('user.subscription')->find(1);
//     // $restaurant = Restaurant::with('categories')
//     //     ->whereRelation('user.subscription', 'end_at', '>=', now())
//     //     ->where('id', 2)
//     //     ->first();
//     // if (!$restaurant) {
//     //     abort(404);
//     // }
//     // echo $restaurant->name;
//     //dd($restaurant);

//     $restuarant = Restaurant::with('categories.menuItems.variations', )
//         ->where('id', 1)
//         ->whereRelation('user.subscription', 'end_at', '>=', now())
//         ->first();
//     dd($restuarant->menuItems->first->variations);

//     // $menuItems = MenuItem::all()->random(10);
//     // dd($menuItems);
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/front.php';
