<div>
    @if ($application->status === 'accept')
        <span class="text-xs text-green-500">Accepted</span>
    @elseif ($application->status === 'reject')
        <span class="text-xs text-red-500">Rejected</span>
    @else
        <span class="text-xs text-yellow-500">Pending</span>
    @endif
    </div>
