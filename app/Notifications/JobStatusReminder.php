<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\JobApplication;


class JobStatusReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public JobApplication $jobApplication,
    )
    {
        //$this
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Notice of Application')
                    ->line("Applicant name: {$this->jobApplication->user->name}")
                    ->line("Greetings, your application for {$this->jobApplication->job->title} has been " .
                    ($this->jobApplication->status === 'accept' ? 'accepted' : 'rejected') . '.')
                    ->line("Company name: {$this->jobApplication->job->employer->company_name}")
                    ->line("Employer: {$this->jobApplication->job->employer->user->name}")
                    ->action('View Application', route('my-job-applications.index'))
                    ->line('Thank you for applying!')
                    ->salutation("Best regards, The Team");  // Customizing the salutation

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'applicant_name' => $this->jobApplication->user->name,
            'job_title' => $this->jobApplication->job->title,
            'job_status' => $this->jobApplication->status,
            'company_name' => $this->jobApplication->job->employer->company_name,
            'job_employer' => $this->jobApplication->job->employer->user->id
        ];
    }
}
