<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\JobApplication;
use App\Models\User;
use App\Events\JobStatusUpdated;
use Illuminate\Support\Facades\Auth;
use App\Notifications\JobStatusReminder;


class JobStatusUpdater extends Component
{
    public $application;
    public $applicationId;

    public $userId;

    public function mount(JobApplication $application)
    {
        $this->application = $application; // Bind the application
        $this->applicationId = $application->id;
        $this->userId = Auth::user()->id;
        // dd("job-verdict".".".$this->applicationId.".".$this->userId);
    }


    public function render()
    {

        if (  $this->application->job->employer->user->id === Auth::user()->id) {
            return view('livewire.job-status-updater');
        } else {
            return view('livewire.employee-job-status-updater');
        }

    }

    public function changeStatus($status)
    {
        $this->application->status = $status;  // Update the status
        $this->application->save();  // Save the changes

        event(new JobStatusUpdated($this->application)); // Laravel will broadcast automatically if your event implements ShouldBroadcast, so in most cases, this alone is enough:

        // broadcast(event: new JobStatusUpdated( $this->application));
    }

    #[On('echo-private:job-verdict.{applicationId}.{userId},JobStatusUpdated')]
    public function listenChangeStatus($event){

        // if ($event['userId'] === $this->userId) {
        //     $jobApplication = JobApplication::with('job.employer', 'user')
        //                         ->find($event['applicationId']);

        //     $user = $jobApplication->user;
        //     $user->notify(new JobStatusReminder(jobApplication: $jobApplication));
        // }

        $this->render();

    }


}
