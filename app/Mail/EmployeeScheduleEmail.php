<?php

namespace App\Mail;

use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmployeeScheduleEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $period;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, CarbonPeriod $period)
    {
        $this->user = $user;
        $this->period = $period;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dates = $this->period->toArray();
        return $this->view('email.employeeSchedule')
                    ->subject($this->user->first_name . " Weekly Time Schedule " .
                        $dates[0]->format('Y-m-d')
                        . " to " . $dates[6]->format('Y-m-d'));

    }
}
