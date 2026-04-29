<x-dashbord-layout>

    <div class="flex flex-col gap-6">

        <div class="flex justify-between items-center">
            <!-- Header -->
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-bold">{{__('Manage Categories')}}</h1>
                <p class="text-primary">{{ __('Manage and organize plant categories for the application.') }}</p>
            </div>

            <!-- Add Button -->
            <button onclick="toggleForm()" id="add-category" class="bg-primary text-white px-4 py-2 rounded flex items-center gap-1">
                <span class="material-symbols-outlined" id="form-icon">add</span>
                <span id="form-label">{{__('Add New Category')}}</span>
            </button>
        </div>

        <!-- ============= Form =============== -->
        <!-- style="max-height:0; overflow:hidden; transition: max-height 0.3s ease;" -->
        <div id="form-panel" class="hidden flex justify-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg  w-1/2">
                <div class="px-8 py-4">
                    <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
                        @csrf
                        <h2 class="font-semibold text-xl leading-tight">
                            {{ __('Add a new Category') }}
                        </h2>

                        <div>
                            <x-input-label for="name" :value="__('Category\'s name')"/>
                            <x-text-input id="name" name="nom_categorie" type="text" class="mt-1 block w-full border-b-2 border-green-700 rounded-none shadow-none outline-none p-2" :value="old('nom_categorie')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nom_categorie')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description_categorie" class="mt-1 block w-full border-b-2 border-green-700 rounded-none outline-none focus:border-indigo-700 p-2" rows="4">{{ old('description_categorie') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description_categorie')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button type="submit" class="bg-green-700 py-3">
                                {{ __('Save') }}
                            </x-primary-button>
                            <button type="button" onclick="toggleForm(false)" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                {{ __('Cancel') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="index-content" class="flex flex-col gap-6">
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
            <div class="bg-white rounded-lg shadow overflow-hidden mb-6 mt-1">
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
                                <span class="px-2 w-fit bg-{{ $categorie->suivis()->exists() ? 'green' : 'red' }}-100 text-{{ $categorie->suivis()->exists() ? 'green' : 'red' }}-600 rounded-full text-xs font-medium">
                                    {{ __($categorie->suivis()->exists() ? 'Active' : 'Inactive') }}
                                </span>
                            </td>
                            <td class="p-2 flex flex-nowrap gap-2 justify-center">
                                <button onclick="toggleForm(true, {{$categorie}})" href="" class="text-yellow-500">
                                    <span class="material-symbols-outlined">edit</span>
                                </button>
                                @if(!$categorie->suivis()->exists())
                                    <form method="POST" action="{{ route('admin.categories.destroy', $categorie) }}"
                                        onsubmit="return confirm('{{ __('Are you sure you want to delete this category : :name?', ['name' => $categorie->nom_categorie]) }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-300 cursor-not-allowed" title="{{ __('Cannot delete an active category') }}">
                                        <span class="material-symbols-outlined">delete</span>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="border-t py-3 px-6 flex justify-end">
                    <div>{{$categories->links()}}</div>
                </div>
            </div>

        </div>

    </div>

    <script>
        const panel = document.getElementById('form-panel');
        const icon  = document.getElementById('form-icon');
        const label = document.getElementById('form-label');
        const main_content = document.getElementById('index-content');

        let open = false;

        function toggleForm(forceOpen, categorie=null) {
            open = forceOpen !== undefined ? forceOpen : !open;
            switch(open){
                case true:
                    panel.classList.remove('hidden')
                    main_content.classList.add('hidden')
                    break;
                case false:
                    panel.classList.add('hidden')
                    main_content.classList.remove('hidden')
                    break;
            }
            icon.textContent  = open ? 'close' : 'add';
            label.textContent = open ? '{{ __("Close") }}' : '{{ __("Add New Category") }}';
            
            if(categorie)
            {
                const my_form = document.forms[1];
                my_form.querySelector('h2').textContent = "Edit a Category"
                my_form.action = `/admin/categories/${categorie.id}`;
                const input_method = document.createElement('input')
                input_method.name = "_method"
                input_method.value = "patch"
                input_method.type = "hidden"

                my_form.append(input_method)

                my_form.nom_categorie.value = categorie.nom_categorie
                my_form.description.value = categorie.description_categorie
                // console.log(categorie)
            }
        }

        // Re-open if validation errors came back
        @if($errors->any())
            toggleForm(true);
        @endif
    </script>

</x-dashbord-layout>