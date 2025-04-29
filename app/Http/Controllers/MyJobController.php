<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Http\Requests\JobRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Events\NewJobPosted;


class MyJobController extends Controller
{

    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $this->authorize('viewAnyEmployer', Job::class);

        // return view('my_job.index', [

        //     'jobs' => auth()->user()->employer()
        //         ->with([
        //             'job.employer',
        //             'job.jobApplications',
        //             'job.jobApplications.user',
        //         ])
        //         ->withCount('job.jobApplications')
        //         ->get()
        // ]);



        return view('my_job.index', [
            'jobs' =>  auth()->user()->employer // Correct relationship name
                ->jobs()
                ->when($request->input('search'), function ($query, $search) {
                    $query->whereHas('jobApplications', function ($query) use ($search) {
                        $query->whereHas('job', function ($query) use ($search) {
                            $query->where('title', 'like', '%' . $search . '%')
                                ->orWhere('description', 'like', '%' . $search . '%');
                        });
                    });
                })
                ->withCount('jobApplications')
                ->withTrashed()
                ->get()
        ]);





        // return view('my_job.index',[
        //     'jobs' => auth()->user()->employer
        //     ->jobs()
        //     ->withCount('jobApplications')
        //     ->withTrashed()
        //     ->get()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Job::class);
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {

        $this->authorize('create', Job::class);

        $newJob = auth()->user()->employer->jobs()->create( $request->validated());

        broadcast(new NewJobPosted($newJob));

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $myJob)
    {
        $myJob->load(relations: 'jobApplications.user')->latest();

        return view('my_job.view', ['job' => $myJob, ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $myJob)
    {
        $this->authorize('update', $myJob);

        return view('my_job.edit', ['job' => $myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $myJob)
    {
        $this->authorize('update', $myJob);

        $myJob->update($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $myJob)
    {
        $myJob->delete();

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job deleted.');
    }
}
