
<x-layout>
        <x-breadcrumbs :links="['My Jobs' => '#', 'View Applications' => '#']" class="mb-4"/>

        {{-- Passing Job --}}
        @livewire('job-application-updates', ['model' => $job])
</x-layout>
