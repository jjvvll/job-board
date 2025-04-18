<x-layout>
{{-- <div id="response">

</div> --}}
    <x-breadcrumbs :links="['My Jobs' => '#', 'View Applications' => '#']" class="mb-4"/>

     @forelse ($job->jobApplications as $application)
        <x-card class="mb-4">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <div>{{$application->user->name}}</div>
                    <div>Applied: {{$application->created_at->diffForHumans()}}</div>
                    <x-link-button href="{{ route('cv.view', $application->id) }}" target='_blank'>View CV</x-link-button>
                </div>
                <div>
                    ${{number_format($application->expected_salary)}}
                </div>
                <div>
                    @if ($application->status === 'accept')
                        <span class="text-xs text-green-500">Accepted</span>
                    @elseif ($application->status === 'reject')
                        <span class="text-xs text-red-500">Rejected</span>
                    @else
                        <span class="text-xs text-yellow-500">Pending</span>
                    @endif
                </div>
                <div>
                    <x-link-button  data-application-id="{{ $application->id }}" href="{{ route('my-job-applications.jobStatus', ['myJobApplication' => $application->id, 'stat' => 'accept']) }}">Accept</x-link-button>
                    <x-link-button href="{{ route('my-job-applications.jobStatus', ['myJobApplication' => $application->id, 'stat' => 'reject']) }}">Reject</x-link-button>
                </div>
            </div>
        </x-card>

        <script type="module">
            console.log(window.Echo);
            window.Echo.channel('test-channel').listen('JobStatusUpdated', (event) =>{
                console.log(event);
                // const responseElement = document.querySelector('#response');

                // responseElement.innerHTML+=`<div class="alert alert-info">Testing</div>`;
            }).error((error) => {
                console.error('Echo error:', error);
            });

        </script>

    @empty
        <div>No applications yet</div>
    @endforelse
</x-layout>
