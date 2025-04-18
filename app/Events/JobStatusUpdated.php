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

class JobStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $jobApplication;

    public function __construct(JobApplication $jobApplication)
    {
        $this->jobApplication = $jobApplication;


        // dd('Inside Event:', $this->jobApplication->id, $this->jobApplication->status);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel('job.application.' . $this->jobApplication->id);
    }


    // Event data to broadcast
    public function broadcastWith()
    {
        dd([
            'status' => $this->jobApplication->status,
            'applicationId' => $this->jobApplication->id,
            'userId' => $this->jobApplication->user_id,
        ]);

        return [
            'status' => $this->jobApplication->status,
            'applicationId' => $this->jobApplication->id,
            'userId' => $this->jobApplication->user_id,
        ];
    }

    // Event name (optional)
    public function broadcastAs()
    {
        return 'JobStatusUpdated';
    }

}
