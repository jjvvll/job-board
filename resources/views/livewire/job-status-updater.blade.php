<div>
    @if ($application->status === 'accept')
        <span class="text-xs text-green-500">Accepted</span>
    @elseif ($application->status === 'reject')
        <span class="text-xs text-red-500">Rejected</span>
    @else
        <span class="text-xs text-yellow-500">Pending</span>
    @endif
    <script>
        window.applicationId = @json($application->id);
        window.userId = @json($application->user->id);
    </script>


    <x-button wire:click="changeStatus('accept')">Accept</x-button>
    <x-button wire:click="changeStatus('reject')">Reject</x-button>


    {{-- <button wire:click="changeStatus('accept')" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
        Accept
    </button>

    <button wire:click="changeStatus('reject')" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
        Reject
    </button> --}}
</div>
