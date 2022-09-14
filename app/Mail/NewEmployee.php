<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEmployee extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $raw_password;
    public $organization_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, String $raw_password)
    {
        $this->user = $user;
        $this->raw_password = $raw_password;
        $this->organization_name = $user->organization->name;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.newEmployee')
                    ->subject('Welcome to Aurora '. $this->user->first_name);
    }
}
