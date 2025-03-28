<x-card class="mb-4">
    <div class="flex justify-between mb-4">
        <h2 class="text-lg font-medium">{{$job->title}}</h2>
        <div class="text-slate-500">
            ${{number_format($job->salary)}}
        </div>
    </div>

    <div class="mb-4 flex justify-between text-sm text-slate-500 items-center">
        <div class = "flex space-x-4">
            <div>{{$job->employer->company_name}}</div>
            <div>{{$job->location}}</div>
        </div>
        <div class="flex space-x-1 text-xs">
            <x-tag>
                <a href="{{route('jobs.index', ['experience' => $job->experience, 'category' => request('category'),
                'search' => request('search'), 'max_salary' => request('max_salary'), 'min_salary' => request('min_salary')])}}">
                    {{ Str::ucfirst($job->experience)}}
                </a>
            </x-tag>
            <x-tag>
                <a href="{{route('jobs.index', ['category' => $job->category, 'experience' => request('experience'),
                'search' => request('search'), 'max_salary' => request('max_salary'), 'min_salary' => request('min_salary')])}}">
                    {{$job->category}}
                </a>
            </x-tag>
        </div>
    </div>

   {{$slot}}
</x-card>
