<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{

    public function index()
    {
        // $users = User::all();
        // $userdata = array();
        // foreach ($users as $v_user) {
        //     $userdata[] = array(
        //         'organization_customer_identifier' => env('ACC_ORG_ID'),
        //         'program_customer_identifier' => env('ACC_PROG_ID'),
        //         'first_name' => $v_user->first_name,
        //         'last_name' => $v_user->last_name,
        //         'email_address' => $v_user->email,
        //         'member_customer_identifier' => 'fdc_user_id'.$v_user->id,
        //         'member_status' => 'OPEN',
        //         'record_identifier' => time().'-'.$v_user->id,
        //         'product_identifier' => env('ACC_PROD_ID')
        //     );
        // }
        // $import = array(
        //     'import' => array(
        //       'members' => $userdata
        //     ),
        // );
        // return $import;
        //
        // $response = Http::withHeaders([
        //     'Access-Token' => env('ACC_TOKEN'),
        //     'Accept' => 'application/json',
        //     'Content-type' => 'application/json',
        // ])->post( env('ACC_ENDPOINT_URL') . 'imports', $import );
        //
        // return $response->json();

        // $response = Http::withHeaders([
        //     'Access-Token' => env('ACC_TOKEN'),
        //     'Accept' => 'application/json',
        //     'Content-type' => 'application/json',
        // ])->get( env('ACC_ENDPOINT_URL') . 'file/valid_members_csv/3524' );
        // return var_dump($response->body());

        // $cvtdata =  env('ACC_ORG_ID').'-'.env('ACC_PROG_ID').'-'.'fdc_user_id5';
        // $cvt = sha1($cvtdata);
        // dd($cvt);
        // 681ff764643f2649233c21cdf6cce3b3a13753f7


        $user = auth()->user();
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

            $subscription->color        = $this->getSubscriptionStatusLabel($subscription->stripe_status, 'color');
            $subscription->status_text  = $this->getSubscriptionStatusLabel($subscription->stripe_status, 'text');
            $subscription->product_name = $product_name;

        } else {
            $subscription = false;
        }

        $invoices = $user->invoicesIncludingPending();

        return view('dashboard')->with('subscription',$subscription)->with('invoices',$invoices)->with('user',$user);
    }


    public function getSubscriptionStatusLabel($status,$type='color')
    {
        $statuses = array(
            'trialing' => [
                'color' => 'bg-green-300',
                'text' => 'Trial'
            ],
            'active' => [
                'color' => 'bg-green-400',
                'text' => 'Active'
            ],
            'incomplete' => [
                'color' => 'bg-yellow-400',
                'text' => 'Incomplete'
            ],
            'incomplete_expired' => [
                'color' => 'bg-red-400',
                'text' => 'Incomplete/Expired'
            ],
            'past_due' => [
                'color' => 'bg-red-400',
                'text' => 'Past Due'
            ],
            'canceled' => [
                'color' => 'bg-red-400',
                'text' => 'Canceled'
            ],
            'unpaid' => [
                'color' => 'bg-red-400',
                'text' => 'Unpaid'
            ],
        );
        if ($type == 'color')
            return $statuses[$status]['color'];
        if ($type == 'text')
            return $statuses[$status]['text'];


    }



}
