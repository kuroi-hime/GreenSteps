<x-dashbord-layout>

    <div class="flex flex-col gap-5">

        <div class="flex justify-between items-center">
            <!-- Header -->
            <div class="flex flex-col gap-1">
                <h1 class="text-3xl font-bold">{{__('Manage Categories')}}</h1>
                <p class="text-primary">{{ __('Manage and organize plant categories for the application.') }}</p>
            </div>

            <!-- Add Button -->
            <a href="{{ route('admin.categories.create') }}" id="add-category" class="bg-primary text-white px-4 py-2 rounded flex items-center">
                <span class="material-symbols-outlined">add</span>
                {{__('Add New Category')}}
            </a>
        </div>

        <!-- Search + Filters -->
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
    
</x-dashbord-layout>