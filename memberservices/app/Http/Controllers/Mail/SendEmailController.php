<?php
namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{

    public function send()
    {
        $to_name = 'Casey Lee';
        $to_email = 'caseyalee@gmail.com';
        $data = array('name'=>"Casey", "body" => "This is a test mail");
        Mail::send('mail.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject('Laravel Test Mail');
            $message->from(env('MAIL_USERNAME'),'FDC Admin');
        });
    }

}