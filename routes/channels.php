<?php

use Illuminate\Support\Facades\Broadcast;

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


Broadcast::channel('test-channel', function ($user, $id) {
    return true;
});
