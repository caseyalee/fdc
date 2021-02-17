<?php
namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class CheckoutController extends Controller
{


    public function checkout(Request $request)
    {
        $user = auth()->user();
        $type = $request->get('membership');


        if ($type == 'annual') {

            $product_key = env('STRIPE_ANNUAL_SUB');

        } elseif ($type == 'monthly') {

            $product_key = env('STRIPE_MONTHLY_SUB');

        } else {

            abort(404);

        }

        $is_trial = ($request->get('trial') == 1 && $type == 'monthly');

        if ($is_trial)
        {

            $checkout = $user->newSubscription('default', $product_key )->trialDays(7)->checkout(
                [
                    'success_url' => route('dashboard'),
                    'cancel_url' => route('checkout'),
                ]
            );

        } else {

            $checkout = $user->newSubscription('default', $product_key )->checkout(
                [
                    'success_url' => route('dashboard'),
                    'cancel_url' => route('checkout'),
                ]
            );

        }

        return view('checkout', [
            'checkout' => $checkout,
        ]);


    }


    // public function resumeSubscription()
    // {
    //     $user = auth()->user();
    //     $subscription = $user->subscription('default');
    //     if ($subscription->onGracePeriod()) {
    //         $message = 'Subscription updated: Queued to resume.';
    //         $subscription->resume();
    //     } else {
    //         if ($subscription->stripe_status == 'canceled') {
    //             $message = 'Your subscription was canceled and must be renewed. Please select a plan below.';
    //             return redirect()->route('renew')->with('status', $message);
    //         } else {
    //             $message = 'This subscription is is not within the grace period to resume.';
    //         }
    //     }
    //     return redirect()->back()->with('status', $message);
    //
    // }

    public function cancelSubscription()
    {
        $user = auth()->user();
        $user->subscription('default')->cancel();
        // $user->subscription('default')->cancelNow();
        return redirect()->back();
    }


    public function checkoutComplete(Request $request)
    {
        return 'cool.';
        // dd($request);
    }

}
