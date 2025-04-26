<?php

namespace App\Events;

use App\Models\JobApplication;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JobStatusUpdated implements ShouldBroadcastNow
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
        // dd('job-verdict.' . $this->jobApplication->id. '.' .  $this->jobApplication->user->id);
        return [
            // new PrivaChannel('test-channel')
            new PrivateChannel('job-verdict.' . $this->jobApplication->id. '.' .  $this->jobApplication->user->id)
        ];
    }


    // Event data to broadcast
    public function broadcastWith()
    {
        // dd([
        //     'status' => $this->jobApplication->status,
        //     'applicationId' => $this->jobApplication->id,
        //     'userId' => $this->jobApplication->user_id,
        // ]);



        return [
            // 'status' => $this->jobApplication->status,
            // 'applicationId' => $this->jobApplication->id,
            // 'userId' => $this->jobApplication->user_id,

            'applicationId' => $this->jobApplication->id,
            'userId' => $this->jobApplication->user_id,
            'applicant_name' => $this->jobApplication->user->name,
            'job_title' => $this->jobApplication->job->title,
            'job_status' => $this->jobApplication->status,
            'company_name' => $this->jobApplication->job->employer->company_name,
            'job_employer' => $this->jobApplication->job->employer->user->id
        ];
    }

    // Event name (optional)
    // public function broadcastAs()
    // {
    //     return 'JobStatusUpdated';
    // }

}
