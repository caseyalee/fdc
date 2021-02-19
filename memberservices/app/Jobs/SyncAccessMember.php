<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SyncAccessMember implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $status;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user,$status)
    {
        $this->user = $user;
        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;
        $status = $this->status ?? 'OPEN';

            $userdata = array(
                'organization_customer_identifier' => env('ACC_ORG_ID'),
                'program_customer_identifier' => env('ACC_PROG_ID'),
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email_address' => $user->email,
                'member_customer_identifier' => env('ACC_MEMBER_PREFIX').$user->id,
                'member_status' => $status, // OPEN
                'record_identifier' => time().'_'.$user->id,
                'product_identifier' => env('ACC_PROD_ID')
            );

            $import = array(
                'import' => array(
                    'members' => array($userdata)
                ),
            );

            $response = Http::withHeaders([
                'Access-Token' => env('ACC_TOKEN'),
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            ])->post( env('ACC_ENDPOINT_URL') . 'imports', $import );

            Log::info("LOG_ACCESS_API_RESPONSE::SyncAccessMember");
            Log::info(var_export($response, true));

    }
}
