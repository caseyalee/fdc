<?php
namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\UserSubscribed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{



    public function send(Request $request)
    {
        $user = auth()->user();
        // Mail::to($request->user())
        Mail::to('caseyalee@gmail.com')->send(new UserSubscribed($user));

    }



    public function preview(Request $request)
    {
        $button = 'https://faithdrivenconsumer.com/contact/';
        $user = auth()->user();
        return new UserSubscribed($user,$button);
    }

}
