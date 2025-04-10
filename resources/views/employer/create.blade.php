<x-layout>
    <x-card>
        <form action="{{route('employer.store')}}" method="POST">
            @csrf
            <x-label for="company_name" :required="true">
                Company name
            </x-label>
            <x-text-input name="company_name" />

            <x-button class="my-4 w-full">Create</x-button>
        </form>
    </x-card>
</x-layout>
