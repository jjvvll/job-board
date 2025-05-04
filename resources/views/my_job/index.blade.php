<x-layout>
    <x-breadcrumbs :links="['My Jobs' => '#', 'Create' => '#']" class="mb-4"/>
        <div class="mb-4 text-sm" x-data="">
            <form x-ref="my-job-filter" id ="filtering-form" action="{{route('my-jobs.index')}}" method="GET">
                <div>
                    {{-- <div class="mb-1 font-semibold">Search</div> --}}
                    <x-text-input name="search" value="{{request('search')}}" placeholder="Search for any job posted" form-ref="my-job-filter"/>
                </div>

                <x-button class="mb-5">Search</x-button>
            </form>
        </div>


    <div class="mb-8 text-right" >
        <x-link-button href="{{route('my-jobs.create')}}">Add new</x-link-button>
    </div>



    <div class="w-full">
        <!-- Toggle Button -->
        <x-button type="button" id="toggle-bulk" class="mb-4">
            Enable Bulk Delete
        </x-button>

        <!-- Bulk Delete Form (hidden by default) -->
        <form method="POST" action="{{ route('jobs.bulk.delete') }}" id="bulk-delete-form" class="hidden">
            @csrf
            <x-button type="submit" class="mb-4">Delete Selected</x-button>
        </form>

        @forelse ($jobs as $job)
        <div class="w-full space-y-4">
            <!-- Bulk Checkbox (hidden by default) -->
            <input type="checkbox" form="bulk-delete-form" name="jobs[]" value="{{ $job->id }}"
                   class="mt-1 bulk-checkbox hidden">

            <x-job-card :job="$job">
                <div class="text-xs text-slate-500">
                    <div>Applications: {{ $job->job_applications_count }}</div>

                    @if (!$job->deleted_at)
                        <div class="flex space-x-2 my-4">
                            <x-link-button href="{{ route('my-jobs.show', $job) }}">View</x-link-button>

                            @if($job->job_applications_count === 0)
                                <x-link-button href="{{ route('my-jobs.edit', $job) }}">Edit</x-link-button>
                            @endif

                            <!-- Individual Delete Form (always visible) -->
                            <form action="{{ route('my-jobs.destroy', $job) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" onclick="return confirm('Delete this job?')">
                                    Delete
                                </x-button>
                            </form>
                        </div>
                    @endif
                </div>
            </x-job-card>
        </div>
        @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8">
            <div class="text-center font-medium">No jobs yet</div>
            <div class="text-center">
                <a class="text-indigo-500 hover:underline" href="{{ route('my-jobs.create') }}">Post your first job</a>
            </div>
        </div>
        @endforelse
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggle-bulk');
        const bulkForm = document.getElementById('bulk-delete-form');
        const checkboxes = document.querySelectorAll('.bulk-checkbox');

        let bulkMode = false;

        toggleBtn.addEventListener('click', function() {
            bulkMode = !bulkMode;

            // Toggle UI elements
            toggleBtn.textContent = bulkMode ? 'Cancel Bulk Delete' : 'Enable Bulk Delete';
            bulkForm.classList.toggle('hidden', !bulkMode);
            checkboxes.forEach(cb => cb.classList.toggle('hidden', !bulkMode));
        });

        // Select All functionality (optional)
        document.getElementById('select-all')?.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    });
    </script>
</x-layout>



