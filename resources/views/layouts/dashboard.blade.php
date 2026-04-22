@php
use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk&display=swap" rel="stylesheet">

<!-- Icons -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Simple Tailwind Config -->
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        primary: "#157F3C",
        secondary: "rgba(21,127,60,0.1)"
      }
    }
  }
}
</script>

</head>

<body class="bg-gray-100 flex">

<!-- ================= SIDEBAR ================= -->
<aside class="w-1/5 bg-white h-screen flex flex-col">

  <!-- Logo -->
    <div class="flex items-center gap-2 p-6">
        <div class="bg-secondary rounded-[0.75rem] p-3">
          <x-application-logo class="block h-6 w-auto fill-current" />
        </div>
        <div class="flex flex-col">
            <h1 class="text-lg font-bold">GreenSteps</h1>
            <p class="text-xs text-primary">Admin Panel</p>
        </div>
    </div>
  

  <!-- Menu -->
  <nav class="space-y-2 flex-1 p-4">
    @php
      $classes = " bg-secondary text-primary rounded-[0.5rem]";
    @endphp
    <div class="flex items-center gap-1 px-[0.6rem]{{ request()->routeIs('dashboard') ? $classes:'' }}">
      <span class="material-symbols-outlined">dashboard</span>
      <a href="{{ route('dashboard') }}" class="block p-2">Dashboard</a>
    </div>
    <div class="flex items-center gap-1 px-[0.6rem]{{ request()->routeIs('admin.categories.index') ? $classes:'' }}">
      <span class="material-symbols-outlined">category</span>
      <a href="{{ route('admin.categories.index') }}" class="block p-2">Categories</a>
    </div>
    <div class="flex items-center gap-1 px-[0.6rem]{{ request()->routeIs('admin.plantes.index') ? $classes:'' }}">
      <span class="material-symbols-outlined">potted_plant</span>
      <a href="{{ Route('admin.plantes.index') }}" class="block p-2">Plants</a>
    </div>
    <div class="flex items-center gap-1 px-[0.6rem]">
      <span class="material-symbols-outlined">group</span>
      <a href="#" class="block p-2">Users</a>
    </div>
    <div class="flex items-center gap-1 px-[0.6rem]">
      <span class="material-symbols-outlined">comment</span>
      <a href="#" class="block p-2">Comments</a>
    </div>
  </nav>

  <!-- Profile + Deconnexion -->
  <div class="flex flex-nowrap items-center gap-4 p-4">
    <div class="bg-secondary size-12 rounded-full flex items-center justify-center">
      <span class="material-symbols-outlined text-primary">supervisor_account</span>
    </div>
    <div>
      <h3 class="font-semibold text-sm">{{ Auth::user()->name }}</h3>
      <p class="text-xs">Admin</p>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <a href="route('logout')"
        onclick="event.preventDefault();this.closest('form').submit();">
        <span class="material-symbols-outlined">logout</span>
      </a>
    </form>
  </div>

</aside>

<!-- ================= MAIN CONTENT ================= -->
<main class="p-8 w-4/5">
  {{ $slot }}
</main>

</body>
</html>