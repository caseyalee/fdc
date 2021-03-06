<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\EmailContentController;
use App\Http\Controllers\Dashboard\MembersController;

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

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('/checkout-complete', [CheckoutController::class, 'checkoutComplete'])->name('checkout-complete');

    Route::get('/cancel', [CheckoutController::class, 'cancelSubscription'])->name('cancel');

    Route::get('/renew', [DashboardController::class, 'renewPage'])->name('renew');

    Route::get('/billing', function (Request $request) {
        // $url = $request->user()->billingPortalUrl(route('dashboard'));
        return $request->user()->redirectToBillingPortal(route('dashboard'));
    })->name('billing');

    Route::get('/marketplace', [DashboardController::class, 'marketplace'])->name('marketplace');
    Route::post('/user/update/{user}', [MembersController::class, 'profileUpdate'])->name('user-profile-update');
    Route::get('/user/profile', [MembersController::class, 'EditProfile'])->name('user-profile');

});

Route::prefix('admin')->middleware(['role:admin'])->group(function () {
    Route::get('/', [EmailContentController::class, 'index'])->name('admin');
    Route::get('/emails', [EmailContentController::class, 'index'])->name('admin-emails');
    Route::get('/emails/edit/{email}', [EmailContentController::class, 'edit'])->name('admin-emails-edit');
    Route::post('/emails/update/{email}', [EmailContentController::class, 'update'])->name('admin-emails-update');
    Route::get('/emails/preview/{email}', [EmailContentController::class, 'preview'])->name('admin-email-preview');
    Route::get('/changelog', '\EmtiazZahid\GitLogLaravel\GitLogLaravelController@index')->name('admin-changelog');
    Route::get('/members', [MembersController::class, 'index'])->name('admin-members');
    Route::get('/members/hubspot', [MembersController::class, 'hubSpotSync'])->name('admin-members-hubspot');
});

require __DIR__.'/auth.php';
