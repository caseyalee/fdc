<?php
namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class CheckoutController extends Controller
{
    public function checkout()
    {

        $user = auth()->user();
        $checkout = $user->newSubscription('default', 'price_1IHJbPDZ5sOLAFdHMxI0SSpj')->trialDays(7)->checkout(
            [
                'success_url' => route('checkout-complete'),
                'cancel_url' => route('checkout'),
            ]
        );

        return view('checkout', [
            'checkout' => $checkout,
        ]);

    }


    public function checkoutComplete(Request $request)
    {
        dd($request);
    }

}
