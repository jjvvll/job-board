<x-layout>


    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
        Sign your account
    </h1>

    <x-card class="py-8 px-16">
        <form action="{{route('password.email') }}" method="POST">
            @csrf


            <x-job-input-fields for="email" name="email" :required="true" fieldName="E-mail" class="mb-8"/>

                {{-- <div class="mb-8">
                    <x-label for="email" :required="true">E-mail</x-label>
                    <x-text-input name="email"/>
                </div> --}}

            <x-button class="w-full bg-green-50">Send</x-button>
        </form>
    </x-card>
</x-layout>
