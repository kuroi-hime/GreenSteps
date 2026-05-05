<x-dashbord-layout>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('admin.categories.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Ajouter une Catégorie') }}
                        </h2>
                        <div>
                            <x-input-label for="name" :value="__('Nom de la catégorie')" />
                            <x-text-input id="name" name="nom_categorie" type="text" class="mt-1 block w-full" :value="old('nom_categorie')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nom_categorie')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description_categorie" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('description_categorie') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description_categorie')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button type="submit">
                                {{ __('Enregistrer') }}
                            </x-primary-button>

                            <a href="{{ route('admin.categories.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                {{ __('Annuler') }}
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-dashbord-layout>














<!-- index -->
<x-dashbord-layout>

    <div class="flex flex-col gap-5">

        <div class="flex justify-between items-center">
            <!-- Header -->
            
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-bold">{{__('Manage Categories')}}</h1>
                <p class="text-primary">{{ __('Manage and organize plant categories for the application.') }}</p>
            </div>

            <!-- Add Button -->
            <button onclick="toggleForm()" id="add-category" class="bg-primary text-white px-4 py-2 rounded flex items-center">
                <span class="material-symbols-outlined">add</span>
                {{__('Add New Category')}}
            </button>
        </div>

        <!-- Search + Filters -->
        {{--
        <div class="bg-white p-3 rounded-[0.75rem] flex gap-4">
            <!-- ***Search*** -->
            <div class="border-2 border-[#E2E8F0] bg-[#E2E8F0] px-4 py-2 flex-1 flex items-center gap-2 rounded-lg">
                <span class="material-symbols-outlined text-[#94A3B8]">search</span>
                <input type="search" name="category-search" id="search" placeholder="{{ __('Search by plant name') }}" class="outline-none bg-transparent flex-1">
            </div>
            <!-- ***filters*** -->
            <div class="flex gap-2 items-center text-sm">
                <select name="status-selector" id="status" class="h-full px-1 outline-none border-2 border-[#E2E8F0] bg-[#E2E8F0] rounded-lg">
                    <option value="" selected>{{ __('All status') }}</option>
                    <option value="true">active</option>
                    <option value="false">inactive</option>
                </select>
            </div>
        </div>
        --}}

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            {{-- table fixed impose que le navigateur respect les width donnés au lieu de laisser le contenu dépassé les bordures des colonnes --}}
            <table class="w-full border bg-white text-center table-fixed">
                <thead>
                <tr class="bg-gray-200 text-xs">
                    <th class="p-4 font-medium w-2/12">{{ __('Name') }}</th>
                    <th class="p-4 font-medium w-8/12">{{ __('Description') }}</th>
                    <th class="p-4 font-medium w-1/12">{{ __('Status') }}</th>
                    <th class="p-4 font-medium w-1/12">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($categories as $categorie)
                    <tr class="hover:bg-gray-100">
                        <td class="px-3 py-2 font-semibold truncate" title="{{ __($categorie->nom_categorie) }}">{{ __($categorie->nom_categorie) }}</td>
                        <td class="p-2 text-left truncate" title="{{ __($categorie->description_categorie) }}">{{ __($categorie->description_categorie) }}</td>
                        <td class="p-2 text-center">
                            <span class="px-2 w-fit bg-{{ $categorie->suivis()->exists() ? 'green' : 'yellow' }}-100 text-{{ $categorie->suivis()->exists() ? 'green' : 'yellow' }}-600 rounded-full text-xs font-medium">
                                {{ __($categorie->suivis()->exists() ? 'Active' : 'Inactive') }}
                            </span>
                        </td>
                        <td class="p-2 flex flex-nowrap gap-2 justify-center">
                            <a href="" class="text-yellow-500">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            <a href="" class="text-red-500">
                                <span class="material-symbols-outlined">delete</span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="border-t py-3 px-6 flex justify-end">
                <div>
                    {{$categories->links()}}
                </div>
            </div>
        </div>
        
    </div>

    <!-- ============= Form =============== -->

        <div id="form-panel" style="max-height:0; overflow:hidden; transition: max-height 0.3s ease;">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
                        @csrf
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Ajouter une Catégorie') }}
                        </h2>

                        <div>
                            <x-input-label for="name" :value="__('Nom de la catégorie')" />
                            <x-text-input id="name" name="nom_categorie" type="text" class="mt-1 block w-full" :value="old('nom_categorie')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nom_categorie')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description_categorie" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('description_categorie') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description_categorie')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button type="submit">
                                {{ __('Enregistrer') }}
                            </x-primary-button>
                            <button type="button" onclick="toggleForm()" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                {{ __('Annuler') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============= Form =============== -->
        <script>
        const panel = document.getElementById('form-panel');
        const icon  = document.getElementById('form-icon');
        const label = document.getElementById('form-label');
        let open = false;

        function toggleForm(forceOpen) {
            open = forceOpen !== undefined ? forceOpen : !open;
            panel.style.maxHeight = open ? panel.scrollHeight + 'px' : '0';
            icon.textContent  = open ? 'close' : 'add';
            label.textContent = open ? '{{ __("Close") }}' : '{{ __("Add New Category") }}';
        }

        // Re-open if validation errors came back
        @if($errors->any())
            toggleForm(true);
        @endif
    </script>

</x-dashbord-layout>
















 {{--
    <div class="bg-black/50 fixed inset-0 flex justify-center items-center">
        <form method="POST" action="{{ route('categories.store') }}" class="bg-white rounded shadow">
            <div class="bg-[#F8FAFC]/50 px-5 py-3 flex justify-between items-center">
            <h2 class="font-semibold">{{ __('Add New Category') }}</h2>
            <svg class="h-8 w-8 text-[#94A3B8]" viewBox="0 0 76 76" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" baseProfile="full" enable-background="new 0 0 76.00 76.00" xml:space="preserve" fill="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="currentColor" fill-opacity="1" stroke-width="0.2" stroke-linejoin="round" d="M 26.9166,22.1667L 37.9999,33.25L 49.0832,22.1668L 53.8332,26.9168L 42.7499,38L 53.8332,49.0834L 49.0833,53.8334L 37.9999,42.75L 26.9166,53.8334L 22.1666,49.0833L 33.25,38L 22.1667,26.9167L 26.9166,22.1667 Z "></path> </g></svg>
            </div>

            <div class="flex flex-col gap-7 p-5">
                <!-- Basic Informations -->
                <div class="flex flex-col gap-4">
                    <h2 class="flex gap-2 items-center text-[#17CF5A]">
                    <svg class="h-5 w-5" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>alarm</title> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="add" fill="currentColor" transform="translate(42.666667, 42.666667)"> <path d="M213.333333,3.55271368e-14 C330.943502,3.55271368e-14 426.666667,95.7231591 426.666667,213.333333 C426.666667,330.943502 330.943502,426.666667 213.333333,426.666667 C95.7231591,426.666667 3.55271368e-14,330.943502 3.55271368e-14,213.333333 C3.55271368e-14,95.7231591 95.7231591,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,42.6666667 C118.87459,42.6666667 42.6666667,118.87459 42.6666667,213.333333 C42.6666667,307.792077 118.87459,384 213.333333,384 C307.792077,384 384,307.792077 384,213.333333 C384,118.87459 307.792077,42.6666667 213.333333,42.6666667 Z M213.333333,272.042667 C228.571429,272.042667 240,283.306667 240,298.666667 C240,314.026667 228.571429,325.290667 213.333333,325.290667 C197.748918,325.290667 186.666667,314.026667 186.666667,298.325333 C186.666667,283.306667 198.095238,272.042667 213.333333,272.042667 Z M234.666667,85.3333333 L234.666667,234.666667 L192,234.666667 L192,85.3333333 L234.666667,85.3333333 Z" id="Combined-Shape"> </path> </g> </g> </g></svg>
                    <span>Basic Informations</span>
                    </h2>

                    <!-- Category Name -->
                    <div class="mb-3">
                    <label for="name">{{ __('Category Name') }}</label>
                    <input id="name" name="nom_categorie" :value="old('nom_categorie')" type="text" placeholder="{{ __('e.g Succulentes') }}" class="w-full border p-2">
                    <x-input-error :messages="$errors->get('nom_categorie')" />
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea 
                        id="description"
                        name="description_categorie"
                        :value="old('description_categorie')"
                        placeholder="{{ __('Brief description of the category') }}..."
                        class="w-full border p-2"
                    ></textarea>
                    <x-input-error :messages="$errors->get('description_categorie')" />
                    </div>

                </div>
            </div>

            <!-- Action Button -->
            <div class="p-4 flex gap-3 justify-end bg-[#F8FAFC] border-t border-[#E2E8F0]">
            <!-- Cancel button -->
            <button class="text-black px-4 py-2 rounded border border-[#CBD5E1]">
                {{__('Cancel')}}
            </button>

            <!-- Save Button -->
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                {{__('Save Category')}}
            </button>
            </div>

        </form>
    </div>
     --}}