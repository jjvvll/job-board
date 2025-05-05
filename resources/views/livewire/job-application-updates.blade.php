<div>
    @forelse ($applications as $app)
    <x-card class="mb-4">
        <div class="mb-4 flex items-center justify-between">
            <div>
                <div>{{$app->user->name}}</div>
                <div>Applied: {{$app->created_at->diffForHumans()}}</div>
                <x-link-button href="{{ route('cv.view', $app->id) }}" target='_blank'>View CV</x-link-button>
            </div>
            <div>
                ${{number_format($app->expected_salary)}}
            </div>
            <div>
                {{$app->status}}
            </div>
            <div>
                @if (!$app->deleted_at)
                    @if ($app->status === 'accept')
                        <span class="text-xs text-green-500">Accepted</span>
                        <x-button wire:click="changeStatus('reject',  {{ $app->id }})">Reject</x-button>
                    @elseif ($app->status === 'reject')
                        <x-button wire:click="changeStatus('accept', {{ $app->id }})">Accept</x-button>
                        <span class="text-xs text-red-500">Rejected</span>
                    @else
                        <span class="text-xs text-yellow-500">Pending</span>
                        <x-button wire:click="changeStatus('accept', {{ $app->id }})">Accept</x-button>
                        <x-button wire:click="changeStatus('reject',  {{ $app->id }})">Reject</x-button>
                    @endif {{-- This closes the $application->status check --}}


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

