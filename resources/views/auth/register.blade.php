<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!--  -->
        <div class="flex mb-4 w-full gap-1 items-center">
            <div class="flex justify-center items-center p-1 bg-green-100 rounded-full h-10 w-10">
                <span class="material-symbols-outlined">user_attributes</span>
            </div>
            <h1 class=" text-xl font-semibold">{{ __('Register') }}</h1>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full p-2 border-b-4 border-green-700" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full p-2 border-b-4 border-green-700" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full p-2 border-b-4 border-green-700"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full p-2 border-b-4 border-green-700"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 gap-2">
            <a class="underline text-sm text-green-500 dark:text-green-400 hover:text-green-900 dark:hover:text-green-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-green-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="bg-green-700">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
