<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\UserSubscribed;
use Illuminate\Http\Request;
use App\Models\EmailContent;

class EmailContentController extends Controller
{
    public function index()
    {
        $emails = EmailContent::all();
        return view('manage-emails')->with('emails',$emails);
    }

    public function edit(EmailContent $email)
    {
        return view('edit-email')->with('email',$email);
    }

    public function update(Request $request)
    {
        $email = EmailContent::findOrFail($request->get('id'));
        $email->subject = $request->get('subject');
        $email->email_body = $request->get('email_body');
        $email->cta_title = $request->get('cta_title');
        $email->cta_link = $request->get('cta_link');
        $email->save();
        // Preview
        if ($request->has('preview') && class_exists($email->mailer_class)) {

            $user = auth()->user();
            $mailable = $email->mailer_class;
            return new $mailable($user,$email);

        }
        return redirect()->route('admin-emails')->with('status', 'Email ID:'. $email->id . ' successfully updated.');

    }

    public function preview(Request $request)
    {
        $user = auth()->user();
        $message = $email->email_body;
        $button = 'https://faithdrivenconsumer.com/contact/';
        return new UserSubscribed($user,$message,$button);
    }

}
