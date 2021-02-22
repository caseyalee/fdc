<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\SyncAccessMember;
use App\Mail\AdminNotification;
use App\Mail\UserSubscribed;
use App\Models\EmailContent;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Cashier;


use Illuminate\Support\Facades\Log;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;
// use Laravel\Cashier\Cashier;

class DashboardController extends Controller
{

    public function marketplace()
    {
        $user = auth()->user();
        $subscription = $user->subscription('default');
        if ($subscription) {
            $redirect_url = env('ACC_MARKETPLACE_URL') . '?cvt=' . $user->CVT;
            return redirect($redirect_url);
        }
        return redirect()->route('dashboard')->with('status','Please choose a subscription to access the FDC Marketplace.');
    }

    public function index()
    {
        $user = auth()->user();

        // Ensure the user is a stripe customer
        if (!$user->stripe_id) {
            $user->createOrGetStripeCustomer();
            $user->updateStripeCustomer([
                'name' => $user->full_name,
                'description' =>' Web Member ID: '.$user->id.''
            ]);
        }

        // $touser = User::find(6);
        // $email = EmailContent::where('mailer_class','App\Mail\UserSubscribed')->firstOrFail();
        // Mail::to($touser)->queue(new UserSubscribed($touser,$email));

        // SyncAccessMember::dispatch($user,'SUSPEND'); // SUSPEND | OPEN

        $subscription = $user->subscription();

        if ($subscription) {
            $plan         = $subscription->stripe_plan;
            $product_name = 'Marketplace Membership';

            // Annual
            if ($plan == env('STRIPE_ANNUAL_SUB')) {
                $product_name = 'Marketplace Membership (Billed Annually)';

            // Monthly
            } elseif ($plan == env('STRIPE_MONTHLY_SUB')) {
                $product_name = 'Marketplace Membership (Billed Monthly)';
            }

            $subscription->product_name = $product_name;

        } else {
            $subscription = false;
        }

        $invoices = $user->invoicesIncludingPending();

        return view('dashboard')->with('subscription',$subscription)->with('invoices',$invoices)->with('user',$user);
    }



    public function renewPage()
    {
        $user = auth()->user();
        return view('renew')->with('user',$user);
    }



}
