<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Checkout\CheckoutController;

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
});

Route::get('/checkout', function () {
    return view('welcome');
});
Route::get('/checkout', [CheckoutController::class, 'checkout'])->middleware(['auth'])->name('checkout');
Route::get('/checkout-complete', [CheckoutController::class, 'checkoutComplete'])->middleware(['auth'])->name('checkout-complete');

Route::get('/dashboard', function () {
    $user = auth()->user();
    $subs = $user->subscriptions;
    // dd($user->full_name);
    // $stripeCustomer = $user->createOrGetStripeCustomer();
    // $stripeCustomer = $user->updateStripeCustomer(['name'=>$user->full_name,'description'=>'Web Member ID: '.$user->id.'']);

    // $user->assignRole('admin');
    // $stripeCustomer = $user->createOrGetStripeCustomer();
    // dd($stripeCustomer);

    // $role = Role::create(['name' => 'admin']);
    // $role = Role::find(1);;
    // $permission = Permission::create(['name' => 'edit members']);
    // $role->givePermissionTo($permission);
    // $permission->assignRole($role);

    // $user->assignRole($role);
    // dd($user->hasRole('admin'));
    return view('dashboard')->with('subscriptions',$subs);
})->middleware(['auth'])->name('dashboard');

Route::get('/billing-portal', function (Request $request) {
    // $url = $request->user()->billingPortalUrl(route('dashboard'));
    return $request->user()->redirectToBillingPortal(route('dashboard'));
});

require __DIR__.'/auth.php';
