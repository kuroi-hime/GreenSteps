@php
use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icon -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
            {{-- @include('layouts.navigation') --}}

            <!-- Header -->
             <header class="z-[999] flex justify-between items-center px-10 py-4 bg-white shadow-sm sticky top-0">
                <div class="flex items-center gap-1">
                    <div class="p-1 bg-[#157F3C]/10 rounded-xl size-10 flex justify-center items-center">
                        <span class="material-symbols-outlined text-3xl">eco</span>
                    </div>
                    <h1 class="text-xl font-bold text-green-700">GreenSteps</h1>
                </div>

                <nav class="space-x-6 hidden md:block">
                    <a href="{{ route('home') }}" class="hover:text-[#157F3C]">Home</a>
                    <a href="{{ route('client.plantes.index') }}" class="hover:text-[#157F3C]">Plants</a>
                    {{--<a href="{{ route('home') }}" class="hover:text-[#157F3C]">Planting Calendar</a>--}}
                    <a href="{{ route('client.my-garden.index') }}" class="hover:text-[#157F3C]">My Garden</a>
                </nav>

                <div class="space-x-3 flex items-center">
                    @auth
                    <!-- profil -->
                    <a href="{{ route('profile.edit') }}" class="size-10">
                        <img src="https://api.dicebear.com/7.x/initials/svg?seed={{ urlencode(Auth::user()->name) }}" 
                        alt="{{ Auth::user()->name }}" class="size-10 rounded-full">
                    </a>
                    <!-- deconnexion -->
                    <form method="post" action="{{route('logout')}}">
                        <button class="bg-[#157F3C] text-white px-4 py-2 rounded-lg">
                            {{ __('Log out') }}
                        </button>
                    </form>

                    @else
                    <a href="{{ route('register') }}" class="text-[#157F3C]">Register</a>
                    <a href="{{ route('login') }}" class="bg-[#157F3C] text-white px-4 py-2 rounded-lg">Login</a>
                    @endauth
                </div>
            </header>

            <!-- Page Heading -->
            {{-- @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset --}}

            <!-- Page Content -->
            <main class="flex flex-1">
                @if(Auth::user() && Auth::user()->is_blocked)
                @else
                {{ $slot }}
                @endif
            </main>

            <!-- Footer -->
            <footer class="bg-white text-center py-4">
                <p class="text-center text-gray-400">
                    © {{Date('Y')}} GreenSteps. All rights reserved.
                </p>
            </footer>
        </div>
    </body>
</html>
