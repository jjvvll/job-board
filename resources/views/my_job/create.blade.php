<x-layout>
    <x-breadcrumbs :links="['My Jobs' => route('my-jobs.index'), 'Create' => '#']" class="mb-4"/>
    <x-card class="mb-8">
        <form action="{{route('my-jobs.store')}}" method="POST">
            @csrf

            <div class="mb-4 grid grid-cols-2 gap-4">

                <x-job-input-fields for="title" :required="true" name="title" fieldName="Job Title"/>

                <x-job-input-fields for="location" :required="true" name="location" fieldName="Job Location"/>

                <x-job-input-fields class="col-span-2"
                                    for="salary"
                                    :required="true"
                                    name="salary"
                                    fieldName="Salary"
                                    type="number"/>

                <x-job-input-fields class="col-span-2"
                                    for="description"
                                    :required="true"
                                    name="description"
                                    fieldName="Description"
                                    type="textarea"/>


            <div>
                <x-label for="experience" :required="true">Experience</x-label>
                <x-radio-button name="experience" :allOption="false" :value="old('experience')"
                :options="array_combine( array_map('ucfirst',\App\Models\Job::$experience), \App\Models\Job::$experience)"
                />
            </div>

            <div>
                <x-label for="category" :required="true">Category</x-label>
                <x-radio-button name="category" :allOption="false" :value="old('category')"
                    :options="\App\Models\Job::$category" />
            </div>

            <div class="col-span-2">
                <x-button class="w-full">Create Job</x-button>
            </div>
            </div>

        </form>
    </x-card>
</x-layout>
