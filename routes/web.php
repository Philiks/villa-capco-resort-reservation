<?php

use App\Facades\Receipt;
use App\Models\Accommodation;
use App\Models\Reservation;
use Barryvdh\Snappy\Facades\SnappyPdf;
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

Route::get('/accommodations', function () {
    $accommodations = Accommodation::all();
    return view('app.accommodations', compact("accommodations"));
})->name('app.accommodations');

Route::get('/facilities', function () {
    $accommodations = Accommodation::all();
    return view('app.accommodations', compact("accommodations"));
})->name('app.facilities');

Route::get('/', function () {
    return view('welcome');
});

// TODO: To be removed. User will go back to '/' after logging in. 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
