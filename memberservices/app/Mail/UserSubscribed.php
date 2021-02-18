<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserSubscribed extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $email;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $email
     */
    public function __construct($user,$email)
    {
        $this->user = $user;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $email = $this->email;

        $button = null;
        if ($email->cta_title && $email->cta_link) {
            $button = array(
                'title' => $email->cta_title,
                'link' => $email->cta_link
            );
            if ($email->cta_link === '[sso]') {
                $button['link'] = env('ACC_MARKETPLACE_URL') . '?cvt='. $user->CVT;
            }
        }
        $template = $email->template;
        $message = $email->email_body;
        $message = str_replace("[member_id]",$user->access_member_id,$message);
        return $this->subject($email->subject)->markdown($template, [
            'message' => $message,
            'button' => $button,
        ]);

    }
}
