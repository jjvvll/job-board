<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\JobStatusReminder;
use App\Models\JobApplication;


class JobStatusUpdated
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
        // dd($event->jobApplication->user->id);
            // $jobApplication = JobApplication::with('job.employer', 'user')
            //                     ->find($event->jobApplication->id);

            $user = $event->jobApplication->user;
            $user->notify(new JobStatusReminder($event->jobApplication));



    }
}
