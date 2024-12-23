<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $password;
    protected $user;
    public function __construct($password,$user)
    {
        $this->password = $password;
        $this->user     = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@egyfinancejobs.com', 'EgyFinanceJobs')
        ->subject('Forget Password')
        ->view('email.new_password',['password'=>$this->password,'user'=>$this->user]);
    }
}
