
<x-layout>
        <x-breadcrumbs :links="['My Jobs' => '#', 'View Applications' => '#']" class="mb-4"/>
        <div>
            @livewire('new-application', ['job' => $job])
        </div>
</x-layout>
