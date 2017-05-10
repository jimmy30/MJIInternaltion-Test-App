<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;
    
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->email = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->from(Config::get('mail.from.address'), Config::get('mail.from.name'))
                ->subject(Config::get('mail.welcome_email_subject'))
            ->view('emails.welcome')
            ->with('email', $this->email);

    }
}
