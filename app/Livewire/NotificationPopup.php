<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobApplication;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use function Livewire\dispatch;

class NotificationPopup extends Component
{
    public $show = false;
    public $title;
    public $body;
    public $employerId;

    public function mount()
    {
        $this->employerId = auth()->user()->id ?? 0; // Get the authenticated user's ID
        // $this->testing();
    }

    // #[Computed]
    // public function employerId()
    // {
    //     return auth()->user()->id;
    // }

    public function render()
    {
        return view('livewire.notification-popup');
    }
    public function testing(){
        dd('iisdlkfsaljfasl;kj');
    }

    #[On('echo-private:channel-newApplication.{employerId},NewApplication')]
    public function listenStatusForPopup($event){

        // dd('i am here1');

        $jobApplication = JobApplication::with('job.employer', 'user')
        ->find($event['application_id']);

        $this->title = 'Applicant: '.$jobApplication->user->name ?? 'Notification';
        $this->body = 'Position applied for: '.$jobApplication->job->title ?? 'You have a new notification.';

        // Show the notification popup
        $this->show = true;

        $this->dispatch('showSweetAlert', [
            'title' => 'Success!',
            'text' => $this->title . ' successfully applied to ' . $this->body,
            'icon' => 'success'
        ]);
       //Auto-hide the popup after 5 seconds (optional)
        // $this->dispatchBrowserEvent('hide-popup', ['delay' => 5000]);

    }
    public function hidePopup()
    {
        $this->show = false;
    }



}
