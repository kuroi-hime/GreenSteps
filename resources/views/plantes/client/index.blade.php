<x-app-layout>
    <div class="flex-1 bg-gray-50 font-sans text-gray-900">

        <!-- Hero Section -->
        <section class="py-8 px-6 bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto">
                <h2 class="md:text-5xl font-bold leading-tight">
                    Explore <span class="text-green-600">Flora</span>
                </h2>
                <p class="text-gray-500 mt-4">
                    Find the perfect companion for your space. Discover thousands of plants tailored to your environment.
                </p>
            </div>
        </section>

        <!-- Filter Bar -->
        <div class="sticky top-[72px] z-40 bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm">
            <form method="GET" action="{{ route('client.plantes.index') }}"
                    class="max-w-7xl mx-auto px-6 py-2 flex flex-wrap justify-between items-center gap-4">

                <div class="relative flex-grow max-w-md">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <span class="material-symbols-outlined text-xl">search</span>
                    </span>

                    <input name="search"
                        id="search-input"
                        type="text"
                        placeholder="Search plants..."
                        value="{{ request('search') }}"
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#157F3C] focus:border-[#157F3C] outline-none transition-all">
                </div>

                <div>
                    <select name="category" id="filter-category"
                        class="pl-4 pr-10 py-2.5 border border-gray-200 rounded-xl bg-white text-sm font-medium focus:ring-2 focus:ring-[#157F3C] outline-none cursor-pointer hover:border-[#157F3C] transition-colors">
                        <option value="">Category</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" @selected(request('category') == $categorie->id)>
                                {{ $categorie->nom_categorie }}
                            </option>
                        @endforeach
                    </select>

                    <select name="sun" id="filter-sun"
                        class="pl-4 pr-10 py-2.5 border border-gray-200 rounded-xl bg-white text-sm font-medium focus:ring-2 focus:ring-[#157F3C] outline-none cursor-pointer hover:border-[#157F3C] transition-colors">
                        <option value="">Sun</option>
                        <option value="full sun" @selected(request('sun') == 'full sun')>Full Sun</option>
                        <option value="partial shade" @selected(request('sun') == 'partial shade')>Partial Shade</option>
                        <option value="full shade" @selected(request('sun') == 'full shade')>Full Shade</option>
                    </select>

                    <select name="difficulty" id="filter-difficulty"
                        class="pl-4 pr-10 py-2.5 border border-gray-200 rounded-xl bg-white text-sm font-medium focus:ring-2 focus:ring-[#157F3C] outline-none cursor-pointer hover:border-[#157F3C] transition-colors">
                        <option value="">Difficulty</option>
                        <option value="easy" @selected(request('difficulty') == 'easy')>Easy</option>
                        <option value="medium" @selected(request('difficulty') == 'medium')>Medium</option>
                        <option value="hard" @selected(request('difficulty') == 'hard')>Hard</option>
                    </select>

                    <button type="submit"
                            class="text-[#157F3C] font-bold text-sm px-4 hover:bg-green-50 rounded-lg transition-colors">
                        {{ __('Filter') }}
                    </button>

                    <a href="{{ route('client.plantes.index') }}"
                    class="text-[#157F3C] font-bold text-sm px-4 hover:bg-green-50 rounded-lg transition-colors inline-flex items-center h-[38px]">
                        {{ __('Clear all') }}
                    </a>
                </div>
            </form>
        </div>

        <!-- Plant Grid -->
        <section class="max-w-7xl px-6 py-6">

            @php
                $light_icons = ['full sun' => 'wb_sunny',
                                'partial shade' => 'partly_cloudy_day',
                                'full shade' => 'nights_stay'];

                $difficulte_colors = ['easy' => 'yellow',
                                      'medium' => 'orange',
                                      'hard' => 'red']
            @endphp
            <div id="plant-grid" class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($plantes as $plant)
                <div class="flex flex-col justify-between group bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-xl">
                    <div class="flex flex-col relative flex-1 overflow-hidden">
                        <img src="{{ $plant->images->first() ? $plant->images->first()->path_image : asset('/images/not-found_512.png') }}"
                            alt="{{ $plant->nom_commun }}"
                            onerror="this.src = '{{asset('/images/not-found_512.png')}}'"
                            class="w-full flex-1 object-cover">
                        <div class="absolute top-1 left-2">
                            <span class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-xs font-semibold uppercase text-gray-700 shadow-sm">
                                {{ $plant->categorie->nom_categorie }}
                            </span>
                        </div>
                        <form action="{{ route('client.my-garden.add-plant') }}" method="post">
                            @csrf
                            <input type="hidden" name="plante_id" value="{{$plant->id}}">
                            <button title="{{ __('Add it to my garden') }}"
                                class="absolute top-6 right-2 w-10 h-10 bg-[#157F3C] text-white rounded-full flex items-center justify-center shadow-lg">
                                <span class="material-symbols-outlined text-xl">add</span>
                            </button>
                        </form>
                    </div>
                    <div class="p-3">
                        <h3 class="text-lg font-semibold text-green-700 mb-1 group-hover:text-[#157F3C]">
                            {{ $plant->nom_commun }}
                        </h3>
                        <p class="text-gray-400 text-sm mb-2">{{ $plant->nom_scientifique }}</p>
                        <div class="flex items-center justify-between pt-2 border-t border-gray-50">
                            <div class="flex items-center gap-1.5 text-gray-600">
                                <span class="material-symbols-outlined text-orange-400 text-lg">{{ blank($plant->sunlight_plante) ? "wb_sunny" : $light_icons[$plant->sunlight_plante] }}</span>
                                <span class="text-xs font-bold uppercase">{{ blank($plant->sunlight_plante) ? "__" : $plant->sunlight_plante }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 text-gray-600">
                                <span class="material-symbols-outlined text-{{$difficulte_colors[$plant->difficulte_plante]}}-500 text-lg">bar_chart</span>
                                <span class="text-xs font-bold uppercase tracking-tighter">{{ $plant->difficulte_plante }}</span>
                            </div>
                            <a href="{{ route('client.plantes.show', $plant) }}" class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-lg text-[#157F3C]">details</span>
                                <p class="text-xs font-bold uppercase text-gray-600">Details</p>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                    <p id="no-results" class="col-span-1 sm:col-span-3 lg:col-span-5 text-center text-gray-400 py-4 text-lg">No plants found.</p>
                @endforelse
            </div>
            <div class="mt-3">
                {{$plantes->links()}}
            </div>
        </section>

    </div>

</x-app-layout>