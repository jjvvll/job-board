<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Events\SomeoneAppliedToYourJobEvent;


class JobApplicationController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {
        $this->authorize('apply', $job);
        return view('job_application.create', ['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Job $job, Request $request)
    {

        $this->authorize('apply', $job);

        $user = auth()->user();

        $validatedData = $request->validate([
            'expected_salary' => 'required|min:1|max:1000000000',
            'cv' => 'required|file|mimes:pdf|max:2048'
        ]);

        $cvName = now()->format('Y-m-d_H-i-s') . '_' . $user->name . '.pdf'; // Fixed to only save as .pdf
        $file = $request->file('cv');
        // $path = $file->store('cvs', 'private');

        $path = $file->storeAs('cvs', $cvName, 'private');

        $jobApplication = $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            'cv_path' => $path,
            'cv_name' => $cvName
        ]);

        // SomeoneAppliedToYourJobEvent::dispatch($jobApplication);

        // broadcast(new SomeoneAppliedToYourJob($jobApplication));

        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job Application submitted.');
    }

    // $job->jobApplications()->create([
    //     'user_id' => $request->user()->id,
    //     ...$request->validate([
    //         'expected_salary' => 'required|min:1|max:1000000000'
    //     ])
    // ]);

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
