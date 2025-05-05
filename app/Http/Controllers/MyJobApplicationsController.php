<?php
///FOR USER
namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Notifications\JobStatusReminder;
use App\Events\JobStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use App\Events\NewApplication;



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

        broadcast(new NewApplication($myJobApplication));

        return redirect()->back()->with(
            'success',
            'Job application removed.'
        );
    }

    // public function jobStatus(JobApplication $myJobApplication, $stat)
    // {

    //   $myJobApplication->update(['status' => $stat]);

    //   if ($myJobApplication-> === auth()->user()->id) {
    //     dd('i am here');
    //     $jobApplication = JobApplication::with('job.employer', 'user')
    //                         ->find($myJobApplication->id);

    //     $user = $jobApplication->user;
    //     $user->notify(new JobStatusReminder($jobApplication));
    // }


    //    // Fire the event
    //     // event(args: new JobStatusUpdated($myJobApplication));
    //     // event(new JobStatusUpdated($myJobApplication));
    //     // Event::dispatch(new JobStatusUpdated($myJobApplication));
    //     // dd('Event emitted', $myJobApplication);

    //     // broadcast(new JobStatusUpdated($myJobApplication));


    //     return redirect()->back()->with('success', 'Application status updated.');
    // }
}
