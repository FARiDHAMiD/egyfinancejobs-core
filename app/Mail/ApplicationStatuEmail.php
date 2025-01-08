<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationStatuEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    public function __construct($user, $company, $job_title, $new_statu)
    {
        $this->user = $user;
        $this->company = $company;
        $this->job_title = $job_title;
        $this->new_statu = $new_statu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@egyfinancejobs.com', 'EgyFinanceJobs')
            ->subject('Job Application Statu Changes!')
            ->view('email.ApplicationStatuEmail', [
                'user' => $this->user,
                'company' => $this->company,
                'job_title' => $this->job_title,
                'new_statu' => $this->new_statu,
            ]);
    }
}
