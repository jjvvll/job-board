<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Job;
use App\Models\JobApplication;
use Livewire\Attributes\On;


class NewApplication extends Component
{

    public $job;
    public $applications;
    public $employerId;

    public function mount(Job $job){
        $this->job =  $job;

        $this->applications = $this->job->jobApplications()->withTrashed()->get();
       $this->employerId =  $job->employer->user->id;

    }
    public function render()
    {
        return view('livewire.new-application');
    }

    #[On('echo-private:channel-newApplication.{employerId},NewApplication')]
    public function listenStatus($event){
        // $jobApplication = JobApplication::with('job.employer', 'user')
        // ->find($event['application_id']);

        // if($jobApplication ){
        //        $this->applications = $this->applications->push($jobApplication);

        // }else{

        //     $this->applications = $this->applications->reject(function ($app) use ($event) {
        //     return $app->id == $event['application_id'];
        //     });
        // }
        $this->applications = $this->job->jobApplications()->withTrashed()->get();


        // dd(vars: $this->applications);

    }
}
