<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CheckoutController as AdminCheckout;

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


// Sosialite route
Route::get('sign-in-google', [UserController::class, 'google'])->name('user.login.google');
route::get('auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');
// Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

// Midtrans Route
Route::get('payment/success', [CheckoutController::class, 'midtransCallback']);
Route::POST('payment/success', [CheckoutController::class, 'midtransCallback']);


route::middleware(['auth'])->group(function () {
    //Checkout Route
    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success')->middleware('ensureUserRole:user');
    Route::get('checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('checkout.create')->middleware('ensureUserRole:user');
    Route::POST('checkout/{camp}', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('ensureUserRole:user');


    // Dashboard
    route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // User Dashboard
    route::prefix('user/dashboard')->namespace('User')->name('user.')->middleware('ensureUserRole:user')->group(function () {
        Route::get('/', [UserDashboard::class, 'index'])->name('dashboard');
    });

    // Admin Dashboard
    route::prefix('admin/dashboard')->namespace('Admin')->name('admin.')->middleware('ensureUserRole:admin')->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');

        // Admin Checkout
        Route::post('checkout/{checkout}', [AdminCheckout::class, 'update'])->name('checkout.update');
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
