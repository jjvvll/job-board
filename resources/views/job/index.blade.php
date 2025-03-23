<x-layout>
    <x-bread-crumbs class="mb-4"
    :links="['Jobs' => route('jobs.index')]"/>

    <x-card class="mb-4 text-sm">
        <form id ="filtering-form" action="{{route('jobs.index')}}" method="GET">
            <div class="mb-4 grid grid-cols-2 gap-4" >

                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" value="{{request('search')}}" placeholder="Search for any text" form-id="filtering-form"/>
                </div>

                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary" value="{{request('min_salary')}}" placeholder="From" form-id="filtering-form"/>
                        <x-text-input name="max_salary" value="{{request('max_salary')}}" placeholder="To" form-id="filtering-form"/>
                    </div>
                </div>

                <div>
                    <div class="mb-1 font-semibold">Experience</div>
                    <x-radio-button name="experience"
                    :options="array_combine( array_map('ucfirst',\App\Models\Job::$experience), \App\Models\Job::$experience)" />
                </div>

                <div>
                    <div class="mb-1 font-semibold">Category</div>
                    <x-radio-button name="category"
                    :options="\App\Models\Job::$category" />
                </div>

            </div>

            <button class="w-full">Filter</button>
        </form>
    </x-card>

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
