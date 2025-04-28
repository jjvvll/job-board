<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class SomeoneAppliedToYourJob extends Component
{
    public $application;
    public $applicationId;

    public $employerId;

    public function mount(JobApplication $application)
    {
        $this->application = $application; // Bind the application
        $this->applicationId = $application->id;
        $this->employerId = Auth::user()->id;
        // dd("channel-SomeoneAppliedToYourJob".".".$this->applicationId.".".$this->employerId);
    }
    public function render()
    {
        return view('livewire.someone-applied-to-your-job');
    }

    #[On('echo-private:channel-SomeoneAppliedToYourJob.{applicationId}.{employerId},SomeoneAppliedToYourJob')]
    public function listenStatus($event){
        dd('zhialovesme, someone applied');
       $this->render();
    }
}
