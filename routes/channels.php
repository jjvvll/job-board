<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\JobApplication;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// Broadcast::channel('job.application', function ($user, $id) {
//     return true; // or $user->id === $id
// });

// Broadcast::channel('job.application.{id}', function ($user, $id) {
//     // Only allow the user who owns this job application to listen
//     return (int) $user->id === (int) $id;
// });


// Broadcast::channel('test-channel', function ($user, $id) {
//     return true;
// });

// Broadcast::channel('job-verdict.{applicationId}.{userId}', function ($user, $applicationId, $userId) {
//     return (int) $user->id === (int) $userId;
// });

// Broadcast::channel('job-verdict.{applicationId}.{userId}', function ($user, $applicationId, $userId) {
//     return (int) $user->id === (int) $userId || ;
// });


Broadcast::channel('job-verdict.{applicationId}.{userId}', function ($user, $applicationId, $userId) {
    $application = JobApplication::with('job.employer')->find($applicationId);

    // return $application &&
    //        (
    //            $user->id === (int) $userId || // Applicant
    //            $application->job->employer->user_id === $user->id // Employer
    //        );

     // Only the applicant should listen for the event
     return $application && $user->id === (int) $userId;

           //why both employer and applicant needed to hear this channel? the applicant is the only one who needs to listen
});


Broadcast::channel('channel-SomeoneAppliedToYourJob.{applicationId}.{employerId}', function ($user, $applicationId, $employerId) {
    $application = JobApplication::with('job.employer')->find($applicationId);

     return $application && $user->id === (int) $employerId;

});
