<x-dashbord-layout>
  <!-- Manage Plants -->
  <div class="flex flex-col gap-4">
    
    <!-- Header -->
    <div class="flex justify-between items-center">
      <div class="flex flex-col gap-1">
        <h1 class="text-3xl font-bold">Manage Plants</h1>
        <p class="text-primary">Manage your plant database and planting guides</p>
      </div>

      <!-- Add Button -->
      <button class="bg-green-500 text-white px-4 py-2 rounded flex items-center">
        <span class="material-symbols-outlined">add</span>
        Add New Plant
      </button>
    </div>

    <!-- Search + Filters -->
    <div class="bg-white p-3 rounded-[0.75rem] flex gap-4">
      <!-- ***Search*** -->
      <div class="border-2 border-[#E2E8F0] bg-[#E2E8F0] px-4 py-1 flex-1 flex items-center gap-2 rounded-lg">
        <span class="material-symbols-outlined text-[#94A3B8]">search</span>
        <input type="search" name="" id="" placeholder="Search by plant name" class="outline-none bg-transparent flex-1">
      </div>
      <!-- ***filters*** -->
      <div class="flex gap-2 items-center text-sm">
        <div class="relative p-2 border-2 border-[#E2E8F0] rounded-lg">
          <span class="material-symbols-outlined absolute pl-3 left-0 top-1/2 -translate-y-1/2 z-10">Category</span>
          <select name="" id="" class="outline-none pl-6">
            <option value="" disabled selected>Gategory</option>
          </select>
        </div>
        <div class="relative p-2 border-2 border-[#E2E8F0] rounded-lg">
          <span class="material-symbols-outlined absolute pl-3 left-0 top-1/2 -translate-y-1/2 z-10">equalizer</span>
          <select name="" id="" class="outline-none pl-6">
            <option value="" disabled selected>Difficulty</option>
          </select>
        </div>
        <div class="relative p-2 border-2 border-[#E2E8F0] rounded-lg">
          <span class="material-symbols-outlined absolute pl-3 left-0 top-1/2 -translate-y-1/2 z-10">wb_sunny</span>
          <select name="" id="" class="outline-none pl-6">
            <option value="" disabled selected>Sunlight</option>
          </select>
        </div>
        <div class="relative p-2 border-2 border-[#E2E8F0] rounded-lg">
          <span class="material-symbols-outlined absolute pl-3 left-0 top-1/2 -translate-y-1/2 z-10">water_drop</span>
          <select name="" id="" class="outline-none pl-6">
            <option value="" disabled selected>Water</option>
          </select>
        </div>
        <!-- ***Reset Button*** -->
        <button class="p-2 flex items-center">
          <span class="material-symbols-outlined">filter_alt_off</span>
          Reset
        </button>
      </div>
    </div>

    <!-- ================= TABLE ================= -->
    <div class="bg-white rounded-lg shadow overflow-hidden">

      <table class="w-full border bg-white text-center table-fixed">
        <thead>
          <tr class="bg-gray-200 text-xs">
            <th class="p-4 font-medium w-4/12">Plant</th>
            <th class="p-4 font-medium w-3/12">Scientific Name</th>
            <th class="p-4 font-medium w-3/12">Category</th>
            <th class="p-4 font-medium w-1/12">Status</th>
            <th class="p-4 font-medium w-1/12">Actions</th>
          </tr>
        </thead>

        <tbody class="text-sm">
          @foreach($plantes as $plante)
          <tr class="hover:bg-gray-100">
            <td class="pl-4 py-2 flex justify-start items-center gap-4">
              <img src="{{ $plante->images ? $plante->images->first():'images/not-found.png' }}" alt="image de plante" class="border size-12 rounded-lg">
              <p class="text-wrap">{{$plante->nom_commun}}</p>
            </td>
            <td class="p-2 italic">{{$plante->nom_scientifique}}</td>
            <td class="p-2">{{$plante->categorie->nom_categorie}}</td>
            <td class="p-2 text-primary">
              <div class="bg-secondary rounded-lg">Active</div>
            </td>
            <td class="">
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
      <div class="border-t py-3 px-6 flex justify-end items-center">
        {{ $plantes->links() }}
      </div>
    </div>

  </div>
  
</x-dashbord-layout>