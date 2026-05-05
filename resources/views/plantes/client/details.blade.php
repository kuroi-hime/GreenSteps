<x-app-layout>

    <div class="flex flex-1 flex-col bg-[#f6f8f7] w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 min-h-[calc(100vh-140px)]">

            <div class="lg:col-span-5 xl:col-span-5 flex flex-col gap-4">
                
                <!-- Gallery plant's images -->
                <div class="sticky top-24 space-y-4">

                    <!-- Showed image -->
                    <img id="showed-image" class="w-full aspect-[4/3] lg:aspect-[4/5] rounded-2xl overflow-hidden shadow-sm object-cover object-center" 
                        alt="{{$plant->nom_scientifique}}" 
                        src="{{$plant->images->first() ? $plant->images->first()->path_image:'' }}"
                        onerror="this.src = '{{asset('/images/not-found_512.png')}}'">
                    
                    <!-- Other images -->
                    @if($plant->images)
                    <div class="flex gap-4 overflow-x-auto pb-2 custom-scrollbar snap-x">
                        @foreach($plant->images as $img)
                        <img onclick="showSelected" class="object-cover bg-center shrink-0 size-20 rounded-lg overflow-hidden {{ $loop->iteration == 1 ? 'border-2 border-[#157f3c] ring-2 ring-[#157f3c]/20':'border border-transparent hover:border-[#157f3c]/50'}} " 
                            alt="Image {{$loop->iteration}} of plant: {{$plant->nom_commun}}" 
                            src="{{$img->path_image}}">
                        @endforeach
                    </div>
                    @endif
                </div>

            </div>

            <div class="lg:col-span-7 xl:col-span-7 flex flex-col gap-4 pb-10">

                <div class="space-y-4 border-b border-[#e8f2ec] pb-4">
                    
                    <div class="flex justify-between items-start gap-4">

                        <div class="flex items-center gap-2">
                            <h1 class="text-2xl md:text-3xl font-semibold text-[#0e1a13]">{{$plant->nom_commun}}</h1>
                            <p class="text-lg text-[#51946a] font-medium mt-1 p-2 rounded-xl bg-green-100">{{$plant->categorie->nom_categorie}} Plant</p>
                        </div>

                        <div class="flex flex-col items-center justify-center p-2 bg-[#e8f2ec] rounded-lg">
                            <span class="material-symbols-outlined text-[#157f3c]">eco</span>
                            <span class="text-xs font-bold text-[#157f3c] mt-1">{{__(strtoupper($plant->difficulte_plante))}}</span>
                        </div>
                        
                    </div>

                    <span class="text-sm font-medium">+{{$gardens}} gardeners have this</span>
                        
                </div>
                
                <!-- Care requirements -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- frequence arrosage -->
                    <div class="p-4 rounded-xl bg-white border border-[#e8f2ec] flex flex-col items-center text-center gap-2 transition-transform hover:-translate-y-1 duration-300 shadow-sm">
                    
                        <div class="size-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                            <span class="material-symbols-outlined">water_drop</span>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wider text-[#51946a] font-bold">Water</p>
                            <p class="text-sm font-semibold text-[#0e1a13]">Every {{$plant->frequence_arrosage}} days</p>
                        </div>
                        
                    </div>
                
                    <!-- Light -->
                    <div class="p-4 rounded-xl bg-white border border-[#e8f2ec] flex flex-col items-center text-center gap-2 transition-transform hover:-translate-y-1 duration-300 shadow-sm">

                        <div class="size-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-600">
                            <span class="material-symbols-outlined">wb_sunny</span>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wider text-[#51946a] font-bold">Light</p>
                            <p class="text-sm font-semibold text-[#0e1a13]">{{$plant->sunlight_plante}}</p>
                        </div>
                        
                    </div>

                    <!-- Height -->
                    <div class="p-4 rounded-xl bg-white border border-[#e8f2ec] flex flex-col items-center text-center gap-2 transition-transform hover:-translate-y-1 duration-300 shadow-sm">
                        
                        <div class="size-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                            <span class="material-symbols-outlined">straighten</span>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wider text-[#51946a] font-bold">Max height</p>
                            <p class="text-sm font-semibold text-[#0e1a13]">{{$plant->height_plante}} cm</p>
                        </div>
                        
                    </div>

                    <!-- Temps -->
                    <div class="p-4 rounded-xl bg-white border border-[#e8f2ec] flex flex-col items-center text-center gap-2 transition-transform hover:-translate-y-1 duration-300 shadow-sm">

                        <div class="size-10 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
                            <span class="material-symbols-outlined">thermometer</span>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wider text-[#51946a] font-bold">Temp</p>
                            <p class="text-sm font-semibold text-[#0e1a13]">{{$plant->min_temp_plante}}°C - {{$plant->max_temp_plante}}°C</p>
                        </div>

                    </div>

                </div>
                
                <!-- Add to garden button -->
                <form action="" method="post" class="w-full">
                    <button class="w-full flex items-center justify-center gap-2 bg-[#157f3c] hover:bg-[#116831] text-white py-4 px-8 rounded-xl font-bold">
                        <span class="material-symbols-outlined">add_circle</span>
                        Add to my garden
                    </button>
                </form>
                

                <!-- About section -->
                <div class="space-y-3">

                    <h3 class="text-xl font-bold text-[#0e1a13] flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#157f3c]">description</span>
                        About
                    </h3>

                    <p class="text-[#51946a] leading-relaxed font-body">{{__($plant->description_plante)}}</p>
                    
                </div>

                <!-- Care details -->
                <div class="space-y-3 pt-4 border-t border-[#e8f2ec]">

                    <h3 class="text-xl font-bold text-[#0e1a13] flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#157f3c]">build</span>
                        {{__('Care Details')}}
                    </h3>

                    <div class="bg-white rounded-xl border border-[#e8f2ec] divide-y divide-[#e8f2ec]">
                        <details class="group p-4" open="">
                            <summary class="flex cursor-pointer items-center justify-between font-bold text-[#0e1a13]">
                                <span>Watering</span>
                                <span class="transition group-open:rotate-180">
                                    <span class="material-symbols-outlined">expand_more</span>
                                </span>
                            </summary>
                            <div class="mt-2 text-sm text-[#51946a] font-body leading-relaxed">
                                Water every {{$plant->frequence_arrosage}} days, allowing soil to dry out between waterings. Expect to water more often in brighter light and less often in lower light.
                            </div>
                        </details>

                        <details class="group p-4">
                            <summary class="flex cursor-pointer items-center justify-between font-bold text-[#0e1a13]">
                                <span>Humidity</span>
                                <span class="transition group-open:rotate-180">
                                    <span class="material-symbols-outlined">expand_more</span>
                                </span>
                            </summary>
                            <div class="mt-2 text-sm text-[#51946a] font-body leading-relaxed">
                                Normal room humidity is fine, but prefers higher humidity if possible. Consider misting occasionally.
                            </div>
                        </details>

                        <details class="group p-4">
                            <summary class="flex cursor-pointer items-center justify-between font-bold text-[#0e1a13]">
                                <span>Soil</span>
                                <span class="transition group-open:rotate-180">
                                    <span class="material-symbols-outlined">expand_more</span>
                                </span>
                            </summary>
                            <div class="mt-2 text-sm text-[#51946a] font-body leading-relaxed">
                                Use a well-draining potting mix. A mixture of potting soil, perlite, and orchid bark (aroid mix) is ideal.
                            </div>
                        </details>
                    </div>
                    
                </div>

            </div>

        </div>

        <!-- Section commentaires -->
        <div class="mt-6 border-t border-[#e8f2ec] py-4">
            <h2 class="font-semibold mb-6 text-2xl text-[#0e1a13]">{{ __('Comments') }}</h2>

            <div class="space-y-8">
                @auth
                <div class="bg-white p-6 rounded-2xl border border-[#e8f2ec] flex gap-4">
                    <img src="https://api.dicebear.com/7.x/initials/svg?seed={{ urlencode(Auth::user()->name) }}" 
                        alt="{{ Auth::user()->name }}" class="size-12 rounded-full">
                    
                    <div class="flex-1">
                        <h4 class="text-lg font-bold text-[#0e1a13] mb-4">Share your experience</h4>
                        <textarea class="w-full bg-[#f6f8f7] border border-[#e8f2ec] rounded-xl p-4 text-sm focus:ring-2 focus:ring-[#157f3c] focus:border-[#157f3c] resize-none min-h-[100px] placeholder:text-[#51946a]" placeholder="How is your plant growing? Share your tips..."></textarea>
                        <div class="flex justify-end mt-4">
                            <button class="bg-[#15803d] hover:bg-[#116831] text-white px-6 py-2 rounded-lg font-bold text-sm transition-colors shadow-sm">
                                {{__('Post')}}
                            </button>
                        </div>
                    </div>
                </div>
                @endauth

                <div class="space-y-6">
                    @forelse($plant->commentaires as $comment)
                    <div class="flex justify-center gap-4 pb-6 boder-b border-gray-300">
                        <div class="size-12 rounded-full border border-[#e8f2ec] bg-cover bg-center shrink-0" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD_mfmGTAVRY5tEod7pZyK7KDKBNihN7YE-Pz1ihRlMKVIlBm1g-nDIBqWtojdsXSxdltiuhtCFj7VWUkjjQ5AuM0-hjv-Q1P8duWItNHpKFqedjGHZVi0grTI9OgzDgvqJ8YcK-5uIyisiFJUTcS2srsZvKmaazbTN8b-XB7zRzqu9fYA1VbhHs0d0lX8KqEpiZPMTfyyf2uq6RPYNs2mcVJYMMwuOVqqL2iiRnsZGKlE9qXQGjuCF0gtdwu_12u6P97KljcaMk_W5');"></div>
                    
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-2">
                                <h5 class="font-bold text-[#0e1a13]">Elena Rodriguez</h5>
                                <span class="text-xs text-[#51946a]">2 weeks ago</span>
                            </div>
                            <p class="text-sm text-[#0e1a13] leading-relaxed">
                                Such a statement piece! I propagated mine recently and now I have two. The community tips on propagation were spot on. Thanks GreenSteps!
                            </p>
                            <div class="flex justify-end mt-2">
                                <button class="flex items-center gap-1 text-xs font-medium text-gray-500 hover:text-red-500">
                                    <span class="material-symbols-outlined text-lg">report</span> {{__('Report')}}
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="font-medium text-center">{{ __('No comments yet.') }}</p>
                    @endforelse
                </div>

            </div>
        </div>

    </div>
    <script>
        const img_container = document.getElementById('showed-image');

        function showSe
    </script>
</x-app-layout>