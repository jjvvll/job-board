<x-layout>
    <x-bread-crumbs class="mb-4"
    :links="['Jobs' => route('jobs.index'),  $job->title => '#']"/>
    <x-job-card  :$job>
        <p class="text-sm text-slate-500 mb-4">
            {!! nl2br(e($job->description))!!}
        </p>

        @can('apply', $job)
            <x-link-button :href="route('job.application.create', $job)">
                Apply
            </x-link-button>
        @elseif (empty(auth() -> user()->name))
            <div class="text-center text-sm font-medium text-slate-500">
                 You need to <a class="text-indigo-500 hover:underline" href=" {{route('auth.create')}}">sign in </a> to apply
            </div>
        @elseif (auth()->user()->id === $job->employer->user->id)
            <div class="text-center text-sm font-medium text-slate-500">
                 You are seeing this job as an applicant.
            </div>
        @else
            <div class="text-center text-sm font-medium text-slate-500">
                You already applied to this job
            </div>
        @endcan

    </x-job-card>

    <x-card class="mb-4">
       <h2 class="mb-4 text-lg font-medium">
        More jobs from: {{$job->employer->company_name}}
       </h2>

       <div class="text-sm text-slate-500">
            @foreach ($job->employer->jobs as $otherJob)
                <div class="mb-4 flex justify-between">
                    <div>
                        <div class="text-slate-700">
                            <a href="{{route('jobs.show', $otherJob)}}">
                                {{$otherJob->title}}
                            </a>
                        </div>
                        <div class="text-xs">
                            {{$otherJob->created_at->diffForHumans()}}
                        </div>
                    </div>
                    <div class="text-xs">${{number_format($otherJob->salary)}}</div>
                </div>
            @endforeach
       </div>
    </x-card>


</x-layout>
