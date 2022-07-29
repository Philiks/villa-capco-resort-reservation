<?php

use App\Http\Controllers\Auth\UserController;
use App\Models\Accommodation;
use App\Models\Addon;
use App\Models\Faq;
use App\Models\Rating;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// TODO: Convert these to Controller.
Route::get('/home', function () {
    $ratings = Rating::where('is_featured', true)->get();
    return view('app.home', compact("ratings"));
})->name('home');

Route::get('/accommodations', function () {
    $accommodations = Accommodation::all();
    return view('app.accommodations', compact("accommodations"));
})->name('accommodations');

Route::get('/facilities', function () {
    $addons = Addon::all();
    return view('app.facilities', compact("addons"));
})->name('facilities');

Route::get('/faqs', function () {
    $faqs = Faq::all();
    return view('app.faqs', compact("faqs"));
})->name('faqs');

Route::get('/reservations/{accommodation_id?}/{package_id?}', function ($accommodation_id = null, $package_id = null) {
    return view('app.reservations', ['accommodation_id' => $accommodation_id, 'package_id' => $package_id]);
})->name('reservations');

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/admin', function () {
    return redirect('/admin/accommodations');
});

Route::middleware('auth')->group(function () {
    /*
     * Guest (customer) routes.
     */

    Route::resource('user', UserController::class)
        ->only(['show', 'edit', 'update']);
});

require __DIR__.'/auth.php';
