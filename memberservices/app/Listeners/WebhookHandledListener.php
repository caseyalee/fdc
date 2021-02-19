<?php

namespace App\Listeners;

use App\Jobs\SyncAccessMember;
use App\Mail\UserSubscribed;
use App\Models\EmailContent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Cashier;

// does not need to go on queue - just a listener to the webhook - this is a dispatcher only

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
                $email = EmailContent::where('mailer_class','App\Mail\UserSubscribed')->firstOrFail();

                // Push User to Access API
                SyncAccessMember::dispatch($user,'OPEN');

                // Dispatches the welcome email after 3 minutes
                Mail::to($user)->later(now()->addMinutes(3), new UserSubscribed($user,$email));


            }
            Log::info("LOG_STRIPE_WEBHOOK::WebhookHandledListener[customer.subscription.created]");
            Log::info(var_export($event->payload, true));
        }



        if ($event->payload['type'] == 'customer.subscription.deleted') {

            $customer_id = $event->payload['data']['object']['customer'];

            if ($customer_id) {

                $user = Cashier::findBillable($customer_id);
                // Push User to Access API
                SyncAccessMember::dispatch($user,'CLOSE');

            }
            Log::info("LOG_STRIPE_WEBHOOK::WebhookHandledListener[customer.subscription.created]");
            Log::info(var_export($event->payload, true));
        }

    }
}
