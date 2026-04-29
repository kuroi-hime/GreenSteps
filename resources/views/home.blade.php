<x-app-layout>
 
    <div class="bg-gray-50 text-gray-800 pt-4">

        <!-- Hero Section -->
        <section class="grid md:grid-cols-2 gap-10 px-10 py-4 items-center max-h-screen">
        
        <!-- Text -->
        <div>
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                #1 Gardening Companion
            </span>

            <h2 class="text-5xl font-bold mt-6 leading-tight">
                Your Journey to a <span class="text-green-600">Greener Home</span> Starts Here.
            </h2>

            <p class="text-gray-500 mt-4">
                Identify plants instantly, set smart care reminders, and join a thriving community.
            </p>

            <!-- Search -->
            <div class="flex mt-6 bg-white rounded-xl shadow p-2 max-w-md items-center">
                <span class="material-symbols-outlined ml-2">search</span>
                <input type="text" placeholder="Find a plant..." class="flex-1 px-3 border-none outline-none focus:ring-0 ">
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg">Search</button>
            </div>

            <p class="mt-4 text-sm text-gray-500">Join 10,000+ happy gardeners</p>
        </div>

        <!-- Image -->
        <div class="hidden md:inline">
            <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6"
                class="rounded-2xl shadow-lg">
        </div>

        </section>

        <!-- Categories -->
        <section class="px-10 py-20">
            <div class="flex justify-between mb-6">
                <h3 class="text-2xl font-semibold">{{__("Explore Categories")}}</h3>
                @php
                    $cmp = 0
                @endphp
                <button id="view-all" class="text-green-600">
                    {{__('View All')}}
                </button>
            </div>

            <div id="categories-container" class="collapsed grid md:grid-cols-4 gap-6">
                @foreach($categories as $categorie)
                @php $cmp++ @endphp
                <!-- Card -->
                <div class="categorie-card bg-white rounded-xl shadow overflow-hidden{{$cmp <= 4 ? '':' hidden'}}">
                    <img src="" class="h-40 w-full object-cover">
                    <div class="p-4">
                        <h4 class="font-semibold">{{$categorie->nom_categorie}}</h4>
                        {{--<p class="text-sm text-green-500">Purify your air</p>--}}
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Features -->
        <section class="bg-green-50 py-16 px-10 text-center">
            <h3 class="text-3xl font-bold">Everything you need to thrive</h3>
            <p class="text-gray-500 mt-3">
                Simplified care, organized schedules.
            </p>

            <div class="grid md:grid-cols-3 gap-8 mt-10">

                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-xl shadow flex flex-col">
                    <div class="bg-green-100 p-2 rounded-lg flex justify-center items-center w-fit">
                        <span class="material-symbols-outlined text-green-700">photo_camera</span>
                    </div>
                    <h4 class="font-semibold text-lg">Track growth</h4>
                    <p class="text-gray-500 mt-2">Monitor your plant's progress.See how far they've come!</p>
                    <img src="/images/ImageTrackGrowth.png"
                        class="mt-4 rounded-lg">
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-xl shadow flex flex-col">
                    <div class="bg-green-100 p-2 rounded-lg flex justify-center items-center w-fit">
                        <span class="material-symbols-outlined text-green-700">calendar_month</span>
                    </div>
                    <h4 class="font-semibold text-lg">Planting calendar</h4>
                    <p class="text-gray-500 mt-2">
                        Know exactly when to plant and harvest your plant.
                    </p>
                    <img src="/images/ImagePlantingCalendar.png"
                        class="mt-4 rounded-lg">
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-xl shadow flex flex-col">
                    <div class="bg-green-100 p-2 rounded-lg flex justify-center items-center w-fit">
                        <span class="material-symbols-outlined text-green-700">menu_book</span>
                    </div>
                    <h4 class="font-semibold text-lg">Care guides</h4>
                    <p class="text-gray-500 mt-2">
                        Expert advice for every plant. Light, water and soil requirements.
                    </p>
                    <img src="/images/ImageCareGuides.png"
                        class="mt-4 rounded-lg">
                </div>

            </div>
        </section>

    </div>
    
                <script>
                    const categories_container = document.getElementById('categories-container')
                    const categories_card = categories_container.querySelectorAll('.categorie-card')
                    const btn = document.getElementById('view-all')
                    btn.addEventListener('click', ()=>{
                        if(btn.textContent.trim() == "{{__('View All')}}")
                        {
                            btn.innerHTML = "{{__('Collapse')}}"
                            categories_card.forEach((categorie)=>{categorie.classList.remove('hidden')})
                        }
                        else
                        {
                            btn.innerHTML = "{{__('View All')}}"
                            categories_card.forEach((card, index) => {
                                if(index >= 4)
                                    card.classList.add('hidden')
                            });
                        }
                    })
                </script>
</x-app-layout>