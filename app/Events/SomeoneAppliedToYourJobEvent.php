<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\JobApplication;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Livewire\Livewire;



class SomeoneAppliedToYourJobEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $jobApplication;

    public function __construct(JobApplication $jobApplication)
    {
        $this->jobApplication = $jobApplication;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-SomeoneAppliedToYourJob'. $this->jobApplication->id. '.' .$this->jobApplication->job->employer->user->id),
        ];
    }

    // public function broadcastWith(){
    //     // Trigger the notification in the Livewire component
    //     Livewire::emitTo('SomeoneAppliedToYourJob', 'SomeoneAppliedToYourJobEvent', $this->jobApplication);

    //     return [
    //         'id' => $this->jobApplication->id,
    //         'employer' => $this->jobApplication->employer->name,
    //     ];
    // }
}
