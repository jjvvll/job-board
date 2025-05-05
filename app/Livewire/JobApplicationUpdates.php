<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\JobApplication;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use App\Events\JobStatusUpdated;

class JobApplicationUpdates extends Component
{

    public ?Job $job = null;
    public ?JobApplication $application = null;
    public $applications;
    public $employerId;


    public ?int $applicationId = 0;
    public $userId;

    public function mount( $model)
    {
        if ($model instanceof Job) {
            $this->job =  $model;
            $this->applications = $this->job->jobApplications()->withTrashed()->get();
            $this->employerId =  $this->job->employer->user->id;
            $this->userId = Auth::user()->id;

        } elseif ($model instanceof JobApplication) {
            $this->application = $model; // Bind the application
            $this->applicationId = $this->application->id;
            $this->userId = Auth::user()->id;
        }elseif (is_numeric($model)) {
            // Auto-detect model type
            $this->application = JobApplication::where('id', $model)->firstOrFail();
            $this->job = $this->application
                ? $this->application->job
                : Job::findOrFail($model);
        } else {
            throw new \InvalidArgumentException('Invalid model type');
        }
    }
    public function changeStatus($status, $appId)
    {
        $this->application = JobApplication::where('id', $appId)->firstOrFail();
        $this->application->update(['status' => $status]);

        // Refresh the specific application in your collection
        $this->applications = $this->applications->map(function ($app) use ($appId, $status) {
            if ($app->id == $appId) {
                $app->status = $status;
                $app = $app->fresh(); // Reload relationships if needed
            }
            return $app;
        });
        event(new JobStatusUpdated($this->application)); // Laravel will broadcast automatically if your event implements ShouldBroadcast, so in most cases, this alone is enough:
    }

    #[On('echo-private:job-verdict.{applicationId}.{userId},JobStatusUpdated')]
    public function listenJobApplicationChangeStatus($event){

    }

    #[On('echo-private:channel-newApplication.{userId},NewApplication')]
    public function listenApplicationChangeStatus($event){
        $this->applications = $this->job->jobApplications()->withTrashed()->get();
    }

    public function render()
    {

            return view('livewire.job-application-updates');
    }
}
