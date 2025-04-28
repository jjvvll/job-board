{{-- <div
    x-data="{ show: false, message: '' }"
    x-show="show"
    x-transition
    class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow"
    x-text="message"
    @notify.window="show = true; message = $event.detail; setTimeout(() => show = false, 3000)"
    style="display: none;"
></div>
 --}}


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

                    @livewire('job-status-updater', ['application' => $application], key($application->id))


                    </div>
                </div>
            </x-card>

        @empty
            <div>No applications yet</div>
        @endforelse
    </x-layout>
