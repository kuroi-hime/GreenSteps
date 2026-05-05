<x-app-layout>
    <div class="flex flex-col lg:flex-row min-h-screen bg-gray-50/30">
        
        <div class="flex-grow p-6 lg:p-10">
            <div class="flex flex-wrap gap-3 mb-8">
                <button class="bg-[#157F3C] text-white px-5 py-2 rounded-xl text-sm font-bold flex items-center gap-2 shadow-md shadow-green-100">
                    <span class="material-symbols-outlined text-lg">grid_view</span> All Tasks
                </button>
                @foreach(['Sowing' => 'eco', 'Watering' => 'water_drop', 'Pruning' => 'content_cut', 'Harvesting' => 'shopping_basket'] as $label => $icon)
                    <button class="bg-white border border-gray-100 px-5 py-2 rounded-xl text-sm font-bold text-gray-600 flex items-center gap-2 hover:bg-gray-50 transition-colors shadow-sm">
                        <span class="material-symbols-outlined text-lg text-gray-400">{{ $icon }}</span> {{ $label }}
                    </button>
                @endforeach
            </div>

            <div class="flex items-center gap-4 mb-6">
                <button class="p-1 hover:bg-gray-200 rounded-full transition-colors">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <h2 class="text-xl font-black text-gray-900 uppercase tracking-widest">September 2025</h2>
                <button class="p-1 hover:bg-gray-200 rounded-full transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
                <div class="grid grid-cols-7 border-b border-gray-50">
                    @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                        <div class="py-4 text-center text-[10px] font-black uppercase tracking-widest text-gray-400 border-r border-gray-50 last:border-0">
                            {{ $day }}
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-7">
                    @php
                        // مثال لبيانات المهام في التقويم
                        $calendarTasks = [
                            1 => [['label' => 'Monstera', 'color' => 'blue']],
                            5 => [['label' => 'Basil Seeds', 'color' => 'green'], ['label' => 'Tomato', 'color' => 'green']],
                            7 => [['label' => 'Bell Pepper', 'color' => 'orange'], ['label' => '3 Plants', 'color' => 'blue']],
                            11 => [['label' => 'Rose Bush', 'color' => 'orange']],
                            15 => [['label' => 'Lavender', 'color' => 'green']],
                            21 => [['label' => 'Carrots', 'color' => 'orange']],
                        ];
                    @endphp

                    @for ($i = 28; $i <= 31; $i++) {{-- الأيام من الشهر السابق --}}
                        <div class="min-h-[120px] p-4 border-r border-b border-gray-50 text-gray-300 font-bold text-sm">{{ $i }}</div>
                    @endfor

                    @for ($day = 1; $day <= 24; $day++) {{-- أيام الشهر الحالي --}}
                        <div class="min-h-[120px] p-4 border-r border-b border-gray-50 group hover:bg-gray-50/50 transition-colors">
                            <span class="inline-block mb-2 font-black text-sm {{ $day == 7 ? 'bg-green-600 text-white size-7 flex items-center justify-center rounded-full shadow-md shadow-green-100' : 'text-gray-900' }}">
                                {{ $day }}
                            </span>
                            
                            <div class="space-y-1">
                                @if(isset($calendarTasks[$day]))
                                    @foreach($calendarTasks[$day] as $task)
                                        <div class="px-2 py-1 rounded-lg text-[9px] font-bold flex items-center gap-1.5 
                                            {{ $task['color'] == 'blue' ? 'bg-blue-50 text-blue-600' : '' }}
                                            {{ $task['color'] == 'green' ? 'bg-green-50 text-green-600' : '' }}
                                            {{ $task['color'] == 'orange' ? 'bg-orange-50 text-orange-600' : '' }}">
                                            <span class="size-1.5 rounded-full bg-current"></span>
                                            {{ $task['label'] }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="w-full lg:w-[400px] bg-white border-l border-gray-100 p-8">
            <h2 class="text-2xl font-black text-gray-900 mb-8">Tasks for Today</h2>

            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-red-500 flex items-center gap-1">
                        ! Overdue
                    </h3>
                    <span class="bg-red-50 text-red-600 size-5 flex items-center justify-center rounded-md text-[10px] font-bold">2</span>
                </div>
                <div class="bg-red-50/30 border border-red-100/50 rounded-2xl p-4 flex items-center gap-4">
                    <img src="https://images.unsplash.com/photo-1614594975525-e45190c55d0b?w=100" class="size-10 rounded-xl object-cover grayscale" alt="">
                    <div class="flex-grow">
                        <p class="font-bold text-gray-900 text-sm">Prune Rose Bush</p>
                        <p class="text-[10px] text-gray-400 font-medium">Scheduled for Sep 4</p>
                    </div>
                    <input type="checkbox" class="size-5 rounded-md border-gray-200 text-red-500 focus:ring-red-500">
                </div>
            </div>

            <div class="mb-10">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Scheduled</h3>
                    <span class="bg-green-50 text-green-600 size-5 flex items-center justify-center rounded-md text-[10px] font-bold">4</span>
                </div>
                <div class="space-y-3">
                    @php
                        $todayTasks = [
                            ['title' => 'Harvest Bell Peppers', 'sub' => 'Collection: Veggie Bed', 'img' => 'https://images.unsplash.com/photo-1591038332111-4701bc14503a?w=100'],
                            ['title' => 'Water Monstera', 'sub' => 'Living Room', 'img' => 'https://images.unsplash.com/photo-1614594975525-e45190c55d0b?w=100'],
                            ['title' => 'Water Herb Garden', 'sub' => 'Kitchen Window', 'img' => 'https://images.unsplash.com/photo-1599598425947-02064dc94f01?w=100'],
                        ];
                    @endphp
                    @foreach($todayTasks as $t)
                        <div class="p-3 border border-gray-50 rounded-2xl flex items-center gap-4 hover:shadow-sm transition-shadow">
                            <img src="{{ $t['img'] }}" class="size-10 rounded-xl object-cover" alt="">
                            <div class="flex-grow">
                                <p class="font-bold text-gray-900 text-[13px]">{{ $t['title'] }}</p>
                                <p class="text-[10px] text-gray-400">{{ $t['sub'] }}</p>
                            </div>
                            <input type="checkbox" class="size-5 rounded-md border-gray-200 text-[#157F3C] focus:ring-[#157F3C]">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-green-50/50 rounded-3xl p-6 border border-green-100/50 mb-8">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-green-600 text-lg">lightbulb</span>
                    <h4 class="text-[10px] font-black uppercase tracking-wider text-green-700">Gardening Tip</h4>
                </div>
                <p class="text-xs text-green-800/70 leading-relaxed font-medium">
                    Morning is the best time to water your plants. It allows them to absorb moisture before the midday sun evaporates it.
                </p>
            </div>

            <button class="w-full bg-[#157F3C] hover:bg-green-800 text-white py-4 rounded-xl font-bold flex items-center justify-center gap-2 shadow-lg shadow-green-100 transition-all active:scale-95 mb-8">
                <span class="material-symbols-outlined">add</span> Add Task
            </button>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Task Progress</p>
                    <p class="text-xs font-black text-gray-900">25%</p>
                </div>
                <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-green-600 h-full w-1/4 rounded-full"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>