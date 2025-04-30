<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NewApplicationReminder;
use Illuminate\Queue\InteractsWithQueue;

class NewApplication
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle( $event): void
    {
        $employerUser = $event->jobApplication->job->employer->user;
        $employerUser->notify(new NewApplicationReminder($event->jobApplication));

    }
}
