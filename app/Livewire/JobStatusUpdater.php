<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\JobApplication;
use App\Events\JobStatusUpdated;
use Illuminate\Support\Facades\Auth;

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

        broadcast(new JobStatusUpdated( $this->application));
    }

    #[On('echo-private:job-verdict.{applicationId}.{userId},JobStatusUpdated')]
    public function listenChangeStatus($event){
       $this->render();
    }


}
