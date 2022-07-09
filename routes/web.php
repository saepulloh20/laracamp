<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\CheckoutController;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');
// Route::get('login', function () {
//     return view('login');
// })->name('login');

// Route::get('checkout/{camp:slug}', function () {
//     return view('checkout');
// })->name('checkout');

Route::post('checkout/{camp}', [CheckoutController::class, 'store'])->name('checkout.store');

// Sosialite route
Route::get('sign-in-google', [UserController::class, 'google'])->name('user.login.google');
route::get('auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');



route::middleware(['auth'])->group(function () {
    //Checkout Route
    route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('checkout/success}', [CheckoutController::class, 'success'])->name('checkout.success');

    //User Dashboard
    Route::get('checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('checkout.create');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
