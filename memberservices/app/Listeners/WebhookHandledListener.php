<?php

namespace App\Listeners;

use App\Jobs\SyncAccessMember;
use App\Mail\UserSubscribed;
use App\Models\EmailContent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Cashier;

class WebhookHandledListener
{

    /**
     * WebhookHandledListener constructor.
     */
    public function __construct()
    {
        //
    }


    /**
     * @param $event
     */
    public function handle($event)
    {
        // @todo
        // 1. customer.subscription.created
        //  sync with access
        // 2. customer.subscription.deleted
        // sync with access
        // 3. customer.subscription.trial_will_end
        // Email the customer


        // New Subscription
        // customer.subscription.created
        if ($event->payload['type'] == 'customer.subscription.created') {

            $customer_id = $event->payload['data']['object']['customer'];

            if ($customer_id) {

                $user = Cashier::findBillable($customer_id);
                $email = EmailContent::where('mailer_class','App\Mail\UserSubscribed')->firstorFail();

                // Push User to Access API
                SyncAccessMember::dispatch($user,'OPEN');

                // Dispatches the welcome email after 3 minutes
                Mail::to($user)->later(now()->addMinutes(3), new UserSubscribed($user,$email));


            }

            // Log::info("Generic Webhook Handled in listener");
            // Log::info(var_export($event->payload, true));
        }

    }
}
