<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="flex mb-4 w-full gap-1 items-center">
            <div class="flex justify-center items-center p-1 bg-green-100 rounded-full h-10 w-10">
                <span class="material-symbols-outlined">lock</span>
            </div>
            <h1 class=" text-xl font-semibold">{{ __('SingIn') }}</h1>
        </div>
        
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-lg"/>
            <x-text-input id="email" class="block mt-1 w-full p-2 border-b-4 border-green-700" 
                          type="email" name="email" 
                          :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full p-2 border-b-4 border-green-700"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


       <div class="flex items-center justify-end mt-4 gap-2">
            <a class="underline text-sm text-green-500 dark:text-green-400 hover:text-green-900 dark:hover:text-green-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" 
            href="{{ route('register') }}">
                {{ __("Don't have an account? Register now") }}
            </a>
            <x-primary-button class="bg-green-700">
                {{ __('Log in') }}
            </x-primary-button> 
        </div>
    </form>

</x-guest-layout>
