<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class SyncHubSpotJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {

            $subscription = $user->subscription();

            if ($subscription) {

                // Setup hs_content_membership_notes data
                $subscription_type = null;
                if ($subscription->onTrial()) {
                    $subscription_type = 'Trial';
                } elseif ($subscription->cancelled()) {
                    $subscription_type = 'Cancelled';
                } elseif ($subscription->stripe_plan == env('STRIPE_MONTHLY_SUB')) {
                    $subscription_type = 'Monthly';
                } elseif ($subscription->stripe_plan == env('STRIPE_ANNUAL_SUB')) {
                    $subscription_type = 'Annual';
                }

                // Setup date_joined_marketplace date format
                $month = $user->created_at->month;
                $day = $user->created_at->day;
                $year = $user->created_at->year;
                $user_created_date_midnight = Carbon::createMidnightDate($year, $month, $day, $tz = 'UTC');
                $user_created_date = (int)$user_created_date_midnight->getPreciseTimestamp(3);

                $hubspot_data = array(
                    [
                        'property' => 'firstname',
                        'value' => $user->first_name
                    ],
                    [
                        'property' => 'lastname',
                        'value' => $user->last_name
                    ],
                    [
                        'property' => 'address',
                        'value' => $user->address1 . ' ' . $user->address2
                    ],
                    [
                        'property' => 'city',
                        'value' => $user->city
                    ],
                    [
                        'property' => 'state',
                        'value' => $user->state
                    ],
                    [
                        'property' => 'zip',
                        'value' => $user->zip
                    ],
                    [
                        'property' => 'community_member_',
                        'value' => 'Yes'
                    ],
                    [
                        'property' => 'marketplace_member_',
                        'value' => 'Yes'
                    ],
                    [
                        'property' => 'hs_content_membership_notes',
                        'value' => $subscription_type,
                    ],
                    [
                        'property' => 'date_joined_marketplace',
                        'value' => $user_created_date,
                    ],
                    [
                        'property' => 'cvt_access',
                        'value' => $user->cvt,
                    ],
                    [
                        'property' => 'np__opt_in_for_marketing_emails_from_sign_up_',
                        'value' => user->pref_marketing_emails,
                    ],
                    [
                        'property' => 'np__opt_in_for_community_newsletter_from_sign_up_',
                        'value' => $user->pref_newsletter_emails,
                    ],
                    [
                        'property' => 'opt_in_for_sms_',
                        'value' => $user->pref_sms,
                    ],
                );

                $response = \HubSpot::contacts()->createOrUpdate($user->email,$hubspot_data);
                
            }
        }
        Log::info("SyncHubSpotJob Ran");
    }
}
