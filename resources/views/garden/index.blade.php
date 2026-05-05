@php
use Illuminate\Support\Facades\Auth;
@endphp
<x-app-layout>
    <div class="w-full bg-gray-50/50 pb-12">
        
        {{-- Header --}}
        <div class="max-w-7xl mx-auto px-6 py-8 flex flex-wrap justify-between items-end gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">{{$jardin->nom_jardin}}</h1>
                <p class="text-green-600 font-medium">
                    Hello, {{ Auth::user()->name }}. 
                    @if($jardin->plantes)
                        Ready to start your botanical journey?
                    @else
                        Your gardens are looking wonderful today.
                    @endif
                </p>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <span class="material-symbols-outlined text-xl">search</span>
                    </span>
                    <input type="text" placeholder="Find a plant..." 
                        class="pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-full w-64 focus:ring-2 focus:ring-green-500 outline-none shadow-sm">
                </div>
                
                {{-- Add plant button --}}
                <a href="{{ route('client.plantes.index') }}" 
                   class="bg-[#157F3C] hover:bg-green-800 text-white px-6 py-2.5 rounded-lg font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined">add</span>
                    {{ 'Add Plant' }}
                </a>
            </div>
        </div>

        {{-- Section Statistiques --}}
        <div class="max-w-7xl mx-auto px-6 mb-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $stats = [
                        ['label' => 'Total Plants', 'value' => count($jardin->plantes), 'icon' => 'potted_plant', 'color' => 'green'],
                        ['label' => 'Thriving', 'value' => $healthyCount ?? 0, 'icon' => 'eco', 'color' => 'green'],
                        ['label' => 'Tasks', 'value' => $tasksCount ?? 0, 'icon' => 'warning', 'color' => 'orange'],
                    ];
                @endphp

                @foreach($stats as $stat)
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex justify-between items-start hover:border-green-100 transition-colors">
                        <div>
                            <p class="text-sm font-bold text-gray-400 mb-1">{{ $stat['label'] }}</p>
                            <p class="text-4xl font-black text-gray-900">{{ $stat['value'] }}</p>
                        </div>
                        <div class="p-3 bg-{{ $stat['color'] }}-50 rounded-2xl">
                            <span class="material-symbols-outlined text-{{ $stat['color'] }}-500 text-2xl">{{ $stat['icon'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

            {{-- Section Collection --}}
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Your Collection</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($jardin->plantes as $plante)
                        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                            {{-- Image avec Badge Statut --}}
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $plante->images->first()->path_image }}" class="w-full h-full object-cover" alt="">
                                <div class="absolute top-4 left-4">
                                    <span class="bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-700 shadow-sm">
                                        {{ $jardin->nom_jardin }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-black text-gray-900 mb-1">{{ $plante->nom_commun }}</h3>
                                <p class="text-xs text-gray-400 mb-6 italic font-medium">{{ $plante->nom_scientifique }}</p>

                                <div class="flex gap-2">
                                    <a href="{{ route('client.plantes.show', $plante->id) }}" class="flex-grow bg-green-600 text-white py-3 rounded-2xl text-xs font-black flex items-center justify-center gap-2 hover:bg-green-700 transition-all shadow-md shadow-green-100">
                                        <span class="material-symbols-outlined text-sm">visibility</span>
                                        View
                                    </a>
                                    <button class="p-3 bg-blue-50 text-blue-600 rounded-2xl hover:bg-blue-100 transition-all">
                                        <span class="material-symbols-outlined text-sm">water_drop</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
</x-app-layout>