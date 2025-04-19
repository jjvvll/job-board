<?php
///FOR USER
namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Events\JobStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;


class MyJobApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'my_job_application.index',
            [
                'applications' => auth()->user()->jobApplications()
                    ->with([
                        'job' => fn($query) => $query->withCount('jobApplications')
                            ->withAvg('jobApplications', 'expected_salary')
                            ->withTrashed(),
                        'job.employer.user'
                    ])
                    ->latest()->get()
            ]
        );
    }
    public function destroy(JobApplication $myJobApplication)
    {
        $myJobApplication->delete();

        return redirect()->back()->with(
            'success',
            'Job application removed.'
        );
    }

    public function jobStatus(JobApplication $myJobApplication, $stat)
    {

      $myJobApplication->update(['status' => $stat]);

       // Fire the event
        // event(args: new JobStatusUpdated($myJobApplication));
        event(new JobStatusUpdated($myJobApplication));
        // Event::dispatch(new JobStatusUpdated($myJobApplication));
        // dd('Event emitted', $myJobApplication);

        return redirect()->back()->with('success', 'Application status updated.');
    }
}
