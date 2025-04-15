<x-layout>


    <h1 class="my-16 text-center text-4xl font-medium text-slate-600">
        Sign your account
    </h1>

    <x-card class="py-8 px-16">
        <form action="{{route('auth.store')}}" method="POST">
            @csrf

            <x-job-input-fields for="email" name="email" :required="true" fieldName="E-mail" class="mb-8"/>

            <x-job-input-fields for="password" name="password" :required="true" fieldName="Password"  type="password" class="mb-8"/>

            <div class="mb-8 flex justify-between text-sm font-medium">
                <div>
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="remember" class="rounded-sm border border-slate-400">
                        <label for="remember">Remember me</label>
                    </div>
                </div>
                <div>
                    <a href="{{route('password.request')}}" class="text-indigo-600 hover:underline">Forget password?</a>
                </div>
            </div>

            <x-button class="w-full bg-green-50">Login</x-button>
        </form>

        <div class="flex items-center justify-center mt-4 space-x-1">
            <span>No account yet? Click </span>
            <a class = "text-indigo-600 hover:underline" href="{{route('register.create')}}"> here </a>
            <span> to register!</span>
        </div>
    </x-card>
</x-layout>
