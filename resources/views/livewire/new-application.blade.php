<div>
    @forelse ($applications as $application)
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
                @if (!$application->deleted_at)
                    @if ($application->status === 'accept')
                        <span class="text-xs text-green-500">Accepted</span>
                    @elseif ($application->status === 'reject')
                        <span class="text-xs text-red-500">Rejected</span>
                    @else
                        <span class="text-xs text-yellow-500">Pending</span>
                    @endif {{-- This closes the $application->status check --}}

                    <x-button wire:click="changeStatus('accept')">Accept</x-button>
                    <x-button wire:click="changeStatus('reject')">Reject</x-button>

                @else
                    <span class="text-xs text-red-500">Applicaion has been cancelled.</span>
                @endif

            </div>

        </div>
    </x-card>

    @empty
        <div>No applications yet</div>
    @endforelse
</div>

