<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Mail\SendEmailController;

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
    return redirect('/register');
});

Route::get('/checkout', function () {
    return view('welcome');
});
Route::get('/checkout', [CheckoutController::class, 'checkout'])->middleware(['auth'])->name('checkout');
Route::get('/checkout-complete', [CheckoutController::class, 'checkoutComplete'])->middleware(['auth'])->name('checkout-complete');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/cancel', [CheckoutController::class, 'cancelSubscription'])->middleware(['auth'])->name('cancel');
Route::get('/renew', function () {
    return view('renew');
})->name('renew');

Route::get('/billing', function (Request $request) {
    // $url = $request->user()->billingPortalUrl(route('dashboard'));
    return $request->user()->redirectToBillingPortal(route('dashboard'));
})->name('billing');

Route::get('/testmail', [SendEmailController::class, 'send'])->name('testmail');


require __DIR__.'/auth.php';
