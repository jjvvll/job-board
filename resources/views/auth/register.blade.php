<x-layout>

    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
        Create your account
    </h1>

    <x-card class="py-8 px-16">
        <form action="{{route('register.store')}}" method="POST">
            @csrf

            <x-job-input-fields for="name" name="name" :required="true" fieldName="Name" class="mb-4"/>

            <x-job-input-fields for="email" name="email" :required="true" fieldName="E-mail" class="mb-8"/>

            <x-job-input-fields for="password" name="password" :required="true" fieldName="Password"  type="password" class="mb-8"/>.

            <x-job-input-fields for="password" name="password_confirmation" :required="true" fieldName="Password"  type="password" class="mb-8"/>

            {{-- <div class="mb-8">
                <x-label for="name" :required="true">Name</x-label>
                <x-text-input name="name"/>
            </div>

            <div class="mb-8">
                <x-label for="email" :required="true">E-mail</x-label>
                <x-text-input name="email"/>
            </div>

            <div class="mb-8">
                <x-label for="password" :required="true">Password</x-label>
                <x-text-input name="password" type="password"/>
            </div>

            <div class="mb-8">
                <x-label for="password_confirmation" :required="true">Confirm Password</x-label>
                <x-text-input name="password_confirmation" type="password"/>
            </div> --}}

            <x-button class="w-full bg-green-50">Register</x-button>
        </form>
    </x-card>
    </form>
</x-layout>
