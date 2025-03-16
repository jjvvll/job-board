<x-layout>
    <x-bread-crumbs class="mb-4"
    :links="['Jobs' => route('jobs.index')]"/>

    @foreach ($jobs as $job)
        <x-job-card class="mb-4" :$job>

           <div>
            <a href="{{route('jobs.show', $job)}}"
                class="rounded-md border border-slate-300 bg-white px-2.5 py-1.6 text-center text-sm font-semibold text-black shadow-sm hover:bg-slate-100">
                View
            </a>
           </div>

        </x-job-card>
    @endforeach
</x-layout>
