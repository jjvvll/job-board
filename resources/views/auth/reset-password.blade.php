<x-layout>


    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
        Sign your account
    </h1>

    <x-card class="py-8 px-16">
        <form action="{{route('password.update') }}" method="POST">
            @csrf


            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <x-job-input-fields for="password" name="password" :required="true" fieldName="New Password"  type="password" class="mb-8"/>

            <x-job-input-fields for="password" name="password_confirmation" :required="true" fieldName="Confirm Password"  type="password" class="mb-8"/>

            {{-- <div class="mb-8">
                <x-label for="password" :required="true">New Password</x-label>
                <x-text-input name="password" type="password"/>
            </div>

            <div class="mb-8">
                <x-label for="password_confirmation" :required="true">Confirm Password</x-label>
                <x-text-input name="password_confirmation" type="password"/>
            </div> --}}

            <x-button class="w-full bg-green-50">Reset</x-button>
        </form>
    </x-card>
</x-layout>
