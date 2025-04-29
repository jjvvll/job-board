<?php

namespace App\Events;

use App\Models\JobApplication;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewApplication implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

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
            new PrivateChannel('channel-newApplication.'.$this->jobApplication->job->employer->user->id),
        ];
    }

    public function broadcastWith(){
        return[
            'application_id' => $this->jobApplication->id
        ];
    }
}
