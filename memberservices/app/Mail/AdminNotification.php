<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNotification extends Mailable implements ShouldQueue
{
    use Queueable;

    public $subject;
    public $message;

    /**
     * Create a new message instance.
     *
     * @param $subject
     * @param $message
     */
    public function __construct($subject,$message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->markdown('mail.admin-notification', [
            'message' => $this->message
        ]);

    }
}
