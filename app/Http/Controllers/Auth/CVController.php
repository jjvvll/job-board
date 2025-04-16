<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;  // <-- This line is crucial

use App\Models\JobApplication;
use Illuminate\Http\Request;

class CVController extends Controller
{
    public function show(JobApplication $application)
    {
        // $employer = auth()->user()->employer;

        // if ($application->job->employer_id !== $employer->id) {
        //     abort(403, 'Unauthorized access to CV');
        // }

        // Use static filename for now, or fetch from DB if available
        $cvFilename = $application->cv_name; // or: $application->cv_filename;
        $cvPath = storage_path('app/private/cvs/' . $cvFilename);

        if (!file_exists($cvPath)) {
            abort(404, 'CV not found.');
        }

        return response()->file($cvPath);
    }
}
