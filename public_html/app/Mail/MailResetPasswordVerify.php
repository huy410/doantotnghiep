<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\password_reset;

class MailResetPasswordVerify extends Mailable
{
    use Queueable, SerializesModels;
    protected $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->markdown('emails.resetPasswordVerification')->with([
            'url' => $this->url,
        ]);
    }
}
