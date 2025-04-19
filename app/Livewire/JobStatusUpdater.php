<?php

namespace App\Livewire;

use Livewire\Component;

class JobStatusUpdater extends Component
{
    public $applicationId;
    public $status;

    // Listens for the event to update status
    protected $listeners = ['job-status-updated' => 'updateStatus'];

    // Mount method, which will initialize the component with applicationId and status
    public function mount($applicationId, $status)
    {
        $this->applicationId = $applicationId; // Fix this line, use applicationId here
        $this->status = $status;

        // dd('Inside Event:', $this->applicationId, $this->status);
    }

    // Update the status when the event is triggered
    public function updateStatus($data)
    {

        // dd('Inside Event:', $data['applicationId'], $data['status']);
        // Now comparing with the applicationId
        if ($this->applicationId == $data['applicationId']) { // i think this is from the listener
            $this->status = $data['status'];

            $this->emitSelf('statusUpdated');
        }
    }

    // Render the Livewire view
    public function render()
    {
        return view('livewire.job-status-updater');
    }
}
