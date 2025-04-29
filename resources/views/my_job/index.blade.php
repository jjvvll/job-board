<x-layout>
    <x-breadcrumbs :links="['My Jobs' => '#', 'Create' => '#']" class="mb-4"/>

        <form x-ref="search" id ="filtering-form" action="{{route('my-jobs.index')}}" method="GET">
            <div>
                {{-- <div class="mb-1 font-semibold">Search</div> --}}
                <x-text-input name="search" value="{{request('search')}}" placeholder="Search for any job posted" form-ref="search"/>
            </div>

            <x-button class="mb-5">Search</x-button>
        </form>

    <div class="mb-8 text-right" >
        <x-link-button href="{{route('my-jobs.create')}}">Add new</x-link-button>
    </div>


    @forelse ($jobs as $job)
        <x-job-card :job="$job">
            <div class="text-xs text-slate-500">
                <div>
                    Number of Applications: {{$job->job_applications_count}}
                </div>

                    @if (!$job->deleted_at)
                        <div class="flex space-x-2 my-4">
                            <x-link-button href="{{route('my-jobs.show', $job)}}">View</x-link-button>
                        </div>

                        <div class="flex space-x-2 my-4">
                            <x-link-button href="{{route('my-jobs.edit', $job)}}">Edit</x-link-button>
                        </div>

                        <form action="{{route('my-jobs.destroy', $job)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-button>Delete</x-button>
                        </form>
                    @endif
            </div>
        </x-job-card>
    @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8">
            <div class="text-center font-medium">
                No jobs yet
            </div>
            <div class="text-center">
                Post your first job <a class="text-indigo-500 hover:underline" href="{{route('my-jobs.create')}}">here!</a>
            </div>
        </div>
    @endforelse
</x-layout>
