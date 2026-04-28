@php
use Illuminate\Support\Facades\Auth;
@endphp

<x-dashbord-layout>

    <div class="h-full w-full">

        <div>
            <h2 class="text-3xl font-bold">Dashboard Overview</h2>
            <p class="text-primary">
                Welcome back, {{ Auth::user()->name }}. Here's what's happening today.
            </p>
        </div>

        <section class="w-full py-4 flex gap-4 flex-col sm:flex-row">
            {{-- Plants Planted --}}
            <div class="flex-1 bg-white p-4 rounded-lg shadow-sm">
                <p class="bg-green-100 text-sm text-green-700 py-1 px-3 w-fit rounded-xl">
                    Plants Planted
                </p>

                <div class="mt-4 flex items-center justify-between">
                    {{-- Valeur --}}
                    <p class="text-2xl font-bold">
                        {{ $planted_plants ?? '--' }}
                    </p>

                    {{-- icon --}}
                    <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-green-700 text-lg">
                            potted_plant
                        </span>
                    </div>
                </div>

                <p class="mt-2 text-sm text-gray-500">
                    Today
                </p>
            </div>

            {{-- Total Plants --}}
            <div class="flex-1 bg-white p-4 rounded-lg shadow-sm">
                <p class="text-gray-600 font-medium">Total Plants</p>

                <div class="mt-4 flex items-center justify-between">
                    {{-- Valeur --}}
                    <p class="text-2xl font-bold">
                        {{ $total_plants ?? '--' }}
                    </p>

                    {{-- icon --}}
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-700 text-lg">grass</span>
                    </div>
                </div>

                <p class="mt-2 text-sm text-gray-500">
                    All time
                </p>
            </div>

            {{-- Total Users --}}
            <div class="flex-1 bg-white p-4 rounded-lg shadow-sm">
                <p class="text-gray-600 font-medium">Total Users</p>

                <div class="mt-4 flex items-center justify-between">
                    {{-- Valeur --}}
                    <p class="text-2xl font-bold">
                        {{ $total_users ?? '--' }}
                    </p>

                    {{-- icon --}}
                    <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-purple-700 text-lg">group</span>
                    </div>
                </div>

                <p class="mt-2 text-sm text-gray-500">
                    Active users
                </p>
            </div>
        </section>

        <!-- Top categories & plants -->
        <section class="grid grid-cols-2 gap-5 justify-center items-center mt-2 rounded-lg">
            @php
                $rank_colors = [1=>"yellow", 2=>"gray", 3=>"orange", 4=>"emerald", 5=>"blue"];
            @endphp
            <!-- Top Categories -->
            <div class='bg-white p-4 rounded-lg'>
                <h3 class="text-lg font-semibold mb-3">Top 5 categories</h3>

                <div class="space-y-3">
                    @foreach($categories as $categorie)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-{{$rank_colors[$loop->iteration]}}-100 text-{{$rank_colors[$loop->iteration]}}-700 flex items-center justify-center">{{ $loop->iteration }}</span>
                            <p class="font-medium">{{$categorie->nom_categorie}}</p>
                        </div>
                        <p class="text-gray-600">{{ $categorie->suivis_count ?? '—' }} {{__('user(s) choose this category')}}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Top Plants -->
            <div class='bg-white p-4 rounded-lg '>
                <h3 class="text-lg font-semibold mb-3">Top 5 plants</h3>

                <div class="space-y-3">
                    
                    @foreach($plantes as $plante)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-{{$rank_colors[$loop->iteration]}}-100 text-{{$rank_colors[$loop->iteration]}}-700 flex items-center justify-center">{{ $loop->iteration }}</span>
                            <p class="font-medium">{{$plante->nom_commun}}</p>
                        </div>
                        <p class="text-gray-600">{{ $plante->suivis_count ?? '—' }} {{__('user(s) choose this category')}}</p>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>

    </div>
</x-dashbord-layout>