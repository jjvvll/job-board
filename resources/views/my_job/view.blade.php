
<x-layout>
        <x-breadcrumbs :links="['My Jobs' => '#', 'View Applications' => '#']" class="mb-4"/>
        @livewire('new-application', ['job' => $job])
</x-layout>
