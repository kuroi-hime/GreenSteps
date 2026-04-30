<x-dashbord-layout>
  <!-- Manage Plants -->
  <div class="flex flex-col gap-5 relative">
    <div id="messages" class="absolute top-5 right-10">
      @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
          <strong class="font-bold">Success!</strong>
          <span class="block sm:inline">{{ session('success') }}</span>
        </div>
      @endif

      @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
          <strong class="font-bold">Error!</strong>
          <span class="block sm:inline">{{ session('error') }}</span>
        </div>
      @endif
    </div>
    <!-- Header -->
    <div class="flex justify-between items-center">
      <div class="flex flex-col gap-1">
        <h1 class="text-3xl font-bold">Manage Plants</h1>
        <p class="text-primary">Manage your plant database and planting guides</p>
      </div>

      <!-- Add Button — now a button that toggles the modal -->
      <button type="button" id="add-plant-btn" class="bg-green-500 text-white px-4 py-2 rounded flex items-center">
        <span class="material-symbols-outlined">add</span>
        Add New Plant
      </button>
    </div>
    
    <!-- Search + Filters -->
    <div class="bg-white p-3 rounded-[0.75rem] flex gap-4">
      <!-- Search -->
      <div class="border-2 border-[#E2E8F0] bg-[#E2E8F0] px-4 py-1 flex-1 flex items-center gap-2 rounded-lg">
        <span class="material-symbols-outlined text-[#94A3B8]">search</span>
        <input type="search" name="" id="" placeholder="Search by plant name" class="outline-none bg-transparent flex-1">
      </div>
      <!-- Filters -->
      <div class="flex gap-2 items-center text-sm">
        <!-- BUG FIX: "Category" was used as a material icon name — replaced with "category" -->
        <div class="relative p-2 border-2 border-[#E2E8F0] rounded-lg">
          <span class="material-symbols-outlined absolute pl-3 left-0 top-1/2 -translate-y-1/2 z-10">category</span>
          <select name="" id="" class="outline-none pl-6">
            <option value="" disabled selected>Category</option>
          </select>
        </div>
        <div class="relative p-2 border-2 border-[#E2E8F0] rounded-lg">
          <span class="material-symbols-outlined absolute pl-3 left-0 top-1/2 -translate-y-1/2 z-10">equalizer</span>
          <select name="" id="" class="outline-none pl-6">
            <option value="" selected>Difficulty</option>
            <option value="easy" {{ old('difficulte_plante') == 'easy' ? 'selected' : '' }}>Easy</option>
            <option value="medium" {{ old('difficulte_plante') == 'medium' ? 'selected' : '' }}>Medium</option>
            <option value="hard" {{ old('difficulte_plante') == 'hard' ? 'selected' : '' }}>Hard</option>
          </select>
        </div>
        <div class="relative p-2 border-2 border-[#E2E8F0] rounded-lg">
          <span class="material-symbols-outlined absolute pl-3 left-0 top-1/2 -translate-y-1/2 z-10">wb_sunny</span>
          <select name="" id="" class="outline-none pl-6">
            <option value="" selected>Sunlight</option>
            <option value="full sun" {{ old('sunlight_plante') == 'full sun' ? 'selected' : '' }}>Full Sun</option>
            <option value="partial shade" {{ old('sunlight_plante') == 'partial shade' ? 'selected' : '' }}>Partial Shade</option>
            <option value="full shade" {{ old('sunlight_plante') == 'full shade' ? 'selected' : '' }}>Full Shade</option>
          </select>
        </div>
        {{--
        <div class="relative p-2 border-2 border-[#E2E8F0] rounded-lg">
          <span class="material-symbols-outlined absolute pl-3 left-0 top-1/2 -translate-y-1/2 z-10">water_drop</span>
          <select name="" id="" class="outline-none pl-6">
            <option value="" disabled selected>Water</option>
          </select>
        </div>
        --}}
        <!-- Reset Button -->
        <button type="button" class="p-2 flex items-center">
          <span class="material-symbols-outlined">filter_alt_off</span>
          Reset
        </button>
      </div>
    </div>
    
    <!-- TABLE -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <table class="w-full border bg-white text-center table-fixed">
        <thead>
          <tr class="bg-gray-200 text-xs">
            <th class="p-4 font-medium w-3/12">Plant</th>
            <th class="p-4 font-medium w-2/12">Scientific Name</th>
            <th class="p-4 font-medium w-2/12">Category</th>
            <th class="p-4 font-medium w-1/12 text-center">Difficulty</th>
            <th class="p-4 font-medium w-1/12 text-center">Sunlight</th>
            <th class="p-4 font-medium w-1/12 text-center">Watering</th>
            <th class="p-4 font-medium w-1/12 text-center">Status</th>
            <th class="p-4 font-medium w-1/12 text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="text-sm">
          @foreach($plantes as $plante)
          <tr class="hover:bg-gray-100 border-b last:border-b-0">
            <td class="pl-4 py-2 flex justify-start items-center gap-4">
              <img 
                src="{{ $plante->images && $plante->images->first() ? $plante->images->first()->path_image : asset('images/not-found.png') }}" 
                alt="image de plante" 
                class="border size-12 rounded-lg object-cover flex-shrink-0"
              >
              <p class="text-wrap text-left font-medium">{{$plante->nom_commun}}</p>
            </td>
            <td class="p-2 italic text-gray-600">{{$plante->nom_scientifique}}</td>
            <td class="p-2">{{$plante->categorie->nom_categorie}}</td>
            
            <td class="p-2">
              <span class="px-2 py-1 rounded text-[10px] uppercase font-bold
                {{ $plante->difficulte_plante == 'easy' ? 'bg-green-100 text-green-700' : '' }}
                {{ $plante->difficulte_plante == 'medium' ? 'bg-yellow-100 text-yellow-700' : '' }}
                {{ $plante->difficulte_plante == 'hard' ? 'bg-red-100 text-red-700' : '' }}">
                {{$plante->difficulte_plante}}
              </span>
            </td>

            <td class="p-2">
              <div class="flex items-center justify-center gap-1 text-gray-500">
                <span class="material-symbols-outlined text-sm">wb_sunny</span>
                <span class="text-xs uppercase">{{$plante->sunlight_plante}}</span>
              </div>
            </td>

            <td class="p-2 text-blue-600 font-semibold">
              {{$plante->frequence_arrosage }} <span class="text-[10px] text-gray-400">days</span>
            </td>

            <td class="p-2">
              <div class="bg-secondary text-primary rounded-lg py-1 text-xs font-bold">Active</div>
            </td>
            <td class="p-2">
              <div class="flex justify-center items-center gap-1">
                <a href="{{ route('admin.plantes.edit', $plante) }}" class="text-yellow-500 hover:text-yellow-600">
                  <span class="material-symbols-outlined">edit</span>
                </a>
                <form action="{{route('admin.plantes.destroy', $plante)}}" method="POST"
                      onsubmit="return confirm('{{__('Do you really want to delete :name?', ['name' => $plante->nom_commun])}}')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-500 hover:text-red-600">
                    <span class="material-symbols-outlined">delete</span>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="border-t py-3 px-6 flex justify-end items-center bg-gray-50">
        {{ $plantes->links() }}
      </div>
    </div>
    
  </div>

  <!-- MODAL FORM -->
  <div id="plant-form" class="flex justify-center z-[99] fixed inset-0 py-2 max-h-screen w-full bg-black/50 hidden">
    <form method="POST" action="{{route('admin.plantes.store')}}" id="add-plant-form" class="bg-white rounded shadow flex flex-col max-h-full w-full max-w-2xl">
      @csrf

      <!-- Modal Header -->
      <div class="bg-[#F8FAFC]/50 px-5 py-3 flex justify-between items-center shrink-0">
        <h2 class="font-semibold">Add New Plant</h2>
        <button type="button" class="btn-form-close">
          <svg class="h-8 w-8 text-[#94A3B8]" viewBox="0 0 76 76" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
            <path fill="currentColor" fill-opacity="1" stroke-width="0.2" stroke-linejoin="round" d="M 26.9166,22.1667L 37.9999,33.25L 49.0832,22.1668L 53.8332,26.9168L 42.7499,38L 53.8332,49.0834L 49.0833,53.8334L 37.9999,42.75L 26.9166,53.8334L 22.1666,49.0833L 33.25,38L 22.1667,26.9167L 26.9166,22.1667 Z "/>
          </svg>
        </button>
      </div>

      <!-- Scrollable Body -->
      <div class="flex flex-col gap-7 p-5 flex-1 overflow-y-auto">

        <!-- Basic Informations -->
        <div class="flex flex-col gap-4">
          <h2 class="flex gap-2 items-center text-[#17CF5A]">
            <svg class="h-5 w-5" viewBox="0 0 512 512" fill="currentColor"><g transform="translate(42.666667, 42.666667)"><path d="M213.333333,3.55271368e-14 C330.943502,3.55271368e-14 426.666667,95.7231591 426.666667,213.333333 C426.666667,330.943502 330.943502,426.666667 213.333333,426.666667 C95.7231591,426.666667 3.55271368e-14,330.943502 3.55271368e-14,213.333333 C3.55271368e-14,95.7231591 95.7231591,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,42.6666667 C118.87459,42.6666667 42.6666667,118.87459 42.6666667,213.333333 C42.6666667,307.792077 118.87459,384 213.333333,384 C307.792077,384 384,307.792077 384,213.333333 C384,118.87459 307.792077,42.6666667 213.333333,42.6666667 Z M213.333333,272.042667 C228.571429,272.042667 240,283.306667 240,298.666667 C240,314.026667 228.571429,325.290667 213.333333,325.290667 C197.748918,325.290667 186.666667,314.026667 186.666667,298.325333 C186.666667,283.306667 198.095238,272.042667 213.333333,272.042667 Z M234.666667,85.3333333 L234.666667,234.666667 L192,234.666667 L192,85.3333333 L234.666667,85.3333333 Z" id="Combined-Shape"/></g></svg>
            <span>Basic Informations</span>
          </h2>

          <!-- Common Name -->
          <div>
            <label for="nom_commun">Common Name</label>
            <input type="text" id="nom_commun" name="nom_commun" value="{{old('nom_commun')}}" placeholder="e.g Tomato" class="w-full border p-2 mb-1 rounded">
            <x-input-error :messages="$errors->get('nom_commun')" class="mt-1" />
          </div>

          <!-- Scientific Name -->
          <div>
            <label for="nom_scientifique">Scientific Name</label>
            <input type="text" id="nom_scientifique" name="nom_scientifique" value="{{old('nom_scientifique')}}" placeholder="e.g. Solanum lycopersicum" class="w-full border p-2 mb-1 rounded">
            <x-input-error :messages="$errors->get('nom_scientifique')" class="mt-1" />
          </div>

          <!-- Description -->
          <div>
            <label for="description_plante">Description</label>
            <textarea id="description_plante" name="description_plante" placeholder="Brief description of the plant..." class="w-full border p-2 mb-1 rounded">{{old('description_plante')}}</textarea>
            <x-input-error :messages="$errors->get('description_plante')" class="mt-1" />
          </div>

          <div class="flex gap-3">
            <!-- Category -->
            <div class="w-full flex flex-col gap-1">
              <label for="categorie_id">Category</label>
              <select id="categorie_id" class="w-full border p-2 mb-1 rounded" name="categorie_id">
                @foreach($categories as $categorie)
                  <option value="{{$categorie->id}}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                    {{$categorie->nom_categorie}}
                  </option>
                @endforeach
              </select>
              <x-input-error :messages="$errors->get('categorie_id')" class="mt-1" />
            </div>

            <!-- Difficulty -->
            <div class="w-full flex flex-col gap-1">
              <label for="difficulte_plante">Difficulty</label>
              <select id="difficulte_plante" class="w-full border p-2 mb-1 rounded" name="difficulte_plante">
                <option value="easy" {{ old('difficulte_plante') == 'easy' ? 'selected' : '' }}>Easy</option>
                <option value="medium" {{ old('difficulte_plante') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="hard" {{ old('difficulte_plante') == 'hard' ? 'selected' : '' }}>Hard</option>
              </select>
              <x-input-error :messages="$errors->get('difficulte_plante')" class="mt-1" />
            </div>
          </div>
        </div>

        <hr/>

        <!-- Care Requirements -->
        <div class="flex flex-col gap-4">
          <h2 class="flex gap-2 items-center text-[#17CF5A]">
            <svg class="h-5 w-5" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M41.5 10H35.5" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M27.5 6V14" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M27.5 10L5.5 10" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M13.5 24H5.5" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M21.5 20V28" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M43.5 24H21.5" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M41.5 38H35.5" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M27.5 34V42" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M27.5 38H5.5" stroke="currentColor" stroke-width="4" stroke-linecap="round"/></svg>
            <span>Care Requirements</span>
          </h2>

          <div class="flex gap-3">
            <!-- Sunlight -->
            <div class="w-full flex flex-col gap-2 p-3 bg-[#F8FAFC] rounded-lg">
              <label class="flex gap-2 items-center">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none"><path d="M7.5 2.25V0H9V2.25H7.5ZM7.5 16.5V14.25H9V16.5H7.5ZM14.25 9V7.5H16.5V9H14.25ZM0 9V7.5H2.25V9H0ZM13.275 4.275L12.225 3.225L13.5375 1.875L14.625 2.9625L13.275 4.275ZM2.9625 14.625L1.875 13.5375L3.225 12.225L4.275 13.275L2.9625 14.625ZM13.5375 14.625L12.225 13.275L13.275 12.225L14.625 13.5375L13.5375 14.625ZM3.225 4.275L1.875 2.9625L2.9625 1.875L4.275 3.225L3.225 4.275ZM8.25 12.75C7 12.75 5.9375 12.3125 5.0625 11.4375C4.1875 10.5625 3.75 9.5 3.75 8.25C3.75 7 4.1875 5.9375 5.0625 5.0625C5.9375 4.1875 7 3.75 8.25 3.75C9.5 3.75 10.5625 4.1875 11.4375 5.0625C12.3125 5.9375 12.75 7 12.75 8.25C12.75 9.5 12.3125 10.5625 11.4375 11.4375C10.5625 12.3125 9.5 12.75 8.25 12.75ZM8.25 11.25C9.0875 11.25 9.79688 10.9594 10.3781 10.3781C10.9594 9.79688 11.25 9.0875 11.25 8.25C11.25 7.4125 10.9594 6.70312 10.3781 6.12187C9.79688 5.54062 9.0875 5.25 8.25 5.25C7.4125 5.25 6.70312 5.54062 6.12187 6.12187C5.54062 6.70312 5.25 7.4125 5.25 8.25C5.25 9.0875 5.54062 9.79688 6.12187 10.3781C6.70312 10.9594 7.4125 11.25 8.25 11.25Z" fill="#EAB308"/></svg>
                <span>Sunlight</span>
              </label>
              <select class="w-full border p-2 rounded" name="sunlight_plante">
                <option value="full sun" {{ old('sunlight_plante') == 'full sun' ? 'selected' : '' }}>Full Sun</option>
                <option value="partial shade" {{ old('sunlight_plante') == 'partial shade' ? 'selected' : '' }}>Partial Shade</option>
                <option value="full shade" {{ old('sunlight_plante') == 'full shade' ? 'selected' : '' }}>Full Shade</option>
              </select>
              <x-input-error :messages="$errors->get('sunlight_plante')" class="mt-1" />
            </div>

            <!-- Watering -->
            <div class="w-full flex flex-col gap-2 p-3 bg-[#F8FAFC] rounded-lg">
              <label class="flex gap-2 items-center">
                <svg width="12" height="15" viewBox="0 0 12 15" fill="none"><path d="M6.20625 12.75C6.35625 12.7375 6.48438 12.6781 6.59062 12.5719C6.69687 12.4656 6.75 12.3375 6.75 12.1875C6.75 12.0125 6.69375 11.8719 6.58125 11.7656C6.46875 11.6594 6.325 11.6125 6.15 11.625C5.6375 11.6625 5.09375 11.5219 4.51875 11.2031C3.94375 10.8844 3.58125 10.3062 3.43125 9.46875C3.40625 9.33125 3.34063 9.21875 3.23438 9.13125C3.12812 9.04375 3.00625 9 2.86875 9C2.69375 9 2.55 9.06562 2.4375 9.19687C2.325 9.32812 2.2875 9.48125 2.325 9.65625C2.5375 10.7937 3.0375 11.6062 3.825 12.0938C4.6125 12.5813 5.40625 12.8 6.20625 12.75ZM6 15C4.2875 15 2.85938 14.4125 1.71563 13.2375C0.571875 12.0625 0 10.6 0 8.85C0 7.6 0.496875 6.24062 1.49063 4.77187C2.48438 3.30312 3.9875 1.7125 6 0C8.0125 1.7125 9.51562 3.30312 10.5094 4.77187C11.5031 6.24062 12 7.6 12 8.85C12 10.6 11.4281 12.0625 10.2844 13.2375C9.14062 14.4125 7.7125 15 6 15ZM6 13.5C7.3 13.5 8.375 13.0594 9.225 12.1781C10.075 11.2969 10.5 10.1875 10.5 8.85C10.5 7.9375 10.1219 6.90625 9.36563 5.75625C8.60938 4.60625 7.4875 3.35 6 1.9875C4.5125 3.35 3.39062 4.60625 2.63438 5.75625C1.87813 6.90625 1.5 7.9375 1.5 8.85C1.5 10.1875 1.925 11.2969 2.775 12.1781C3.625 13.0594 4.7 13.5 6 13.5Z" fill="#3B82F6"/></svg>
                <span>Watering frequency</span>
              </label>
              <input type="number" name="frequence_arrosage" value="{{old('frequence_arrosage')}}" placeholder="Frequency in days" min="0" class="w-full border p-2 rounded">
              <x-input-error :messages="$errors->get('frequence_arrosage')" class="mt-1" />
            </div>
          </div>

          <div class="flex gap-3">
            <!-- Min Temp -->
            <div class="w-full flex flex-col gap-2 p-3 bg-[#F8FAFC] rounded-lg">
              <label class="flex gap-2 items-center">
                <span class="material-symbols-outlined text-red-500">thermometer</span>
                <span>Temperature (Min)</span>
              </label>
              <input type="number" name="min_temp_plante" value="{{old('min_temp_plante')}}" placeholder="Temperature in C°" step="0.01" class="w-full border p-2 rounded">
              <x-input-error :messages="$errors->get('min_temp_plante')" class="mt-1" />
            </div>

            <!-- Max Temp -->
            <div class="w-full flex flex-col gap-2 p-3 bg-[#F8FAFC] rounded-lg">
              <label class="flex gap-2 items-center">
                <span class="material-symbols-outlined text-red-500">thermometer</span>
                <span>Temperature (Max)</span>
              </label>
              <input type="number" name="max_temp_plante" value="{{old('max_temp_plante')}}" placeholder="Temperature in C°" step="0.01" class="w-full border p-2 rounded">
              <x-input-error :messages="$errors->get('max_temp_plante')" class="mt-1" />
            </div>
          </div>

          <div class="flex gap-3">
            <!-- Height -->
            <div class="w-full flex flex-col gap-2 p-3 bg-[#F8FAFC] rounded-lg">
              <label class="flex gap-2 items-center">
                <span class="material-symbols-outlined text-green-500">straighten</span>
                <span>Height</span>
              </label>
              <input type="number" name="height_plante" value="{{old('height_plante')}}" min="0" step="0.01" placeholder="The height in cm" class="w-full border p-2 rounded">
              <x-input-error :messages="$errors->get('height_plante')" class="mt-1" />
            </div>

            <!-- Harvesting -->
            <div class="w-full flex flex-col gap-2 p-3 bg-[#F8FAFC] rounded-lg">
              <label class="flex gap-2 items-center">
                <span class="material-symbols-outlined text-yellow-700">agriculture</span>
                <span>Harvesting</span>
              </label>
              <input type="number" name="days_to_recolte" value="{{old('days_to_recolte')}}" min="1" placeholder="Days to harvest" class="w-full border p-2 rounded">
              <x-input-error :messages="$errors->get('days_to_recolte')" class="mt-1" />
            </div>
          </div>
        </div>

        <hr/>

        <!-- Plant Photos -->
        <div class="flex flex-col gap-4">
          <h2 class="flex gap-2 items-center text-[#17CF5A] font-bold">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>Plant Photos</span>
          </h2>
          <input type="text" id="img-input" class="cursor-pointer w-full border p-2 rounded" placeholder="Paste an image URL then press Enter"/>
          <x-input-error :messages="$errors->get('images')" class="mt-1" />
          <div id="img-preview" class="grid grid-cols-5 gap-3"></div>
        </div>

        <hr/>

        <!-- Planting Steps -->
        <div class="flex flex-col gap-3">
          <h2 class="flex gap-2 items-center text-[#17CF5A]">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 317.109 317.109"><g><path d="M102.109,53.555h200c8.284,0,15-6.716,15-15s-6.716-15-15-15h-200c-8.284,0-15,6.716-15,15S93.825,53.555,102.109,53.555z"/><path d="M302.109,143.555h-200c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15C317.109,150.27,310.394,143.555,302.109,143.555z"/><path d="M302.109,263.555h-200c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15C317.109,270.271,310.394,263.555,302.109,263.555z"/><path d="M17.826,49.036V86.6c0,4.074,3.32,7.146,7.724,7.146c4.33,0,7.721-3.139,7.721-7.146V30.426c0-3.96-3.247-7.063-7.392-7.063c-3.646,0-5.47,2.446-6.069,3.25c-0.025,0.034-0.05,0.068-0.075,0.104l-6.526,9.232c-1.267,1.378-2.394,3.582-2.394,5.696C10.814,45.675,13.948,48.962,17.826,49.036z"/><path d="M7.63,193.746h29.406c3.849,0,6.981-3.391,6.981-7.559c0-4.124-3.131-7.479-6.981-7.479H15.684v-0.123c0-2.245,5.148-5.878,9.285-8.797c8.229-5.807,18.47-13.033,18.47-25.565c0-11.893-9.216-20.86-21.438-20.86c-11.703,0-20.527,8.044-20.527,18.711c0,6.19,4.029,8.387,7.479,8.387c4.938,0,7.889-3.677,7.889-7.23c0-2.209,0.568-4.745,4.994-4.745c5.979,0,6.151,5.298,6.151,5.902c0,4.762-6.18,9.214-12.157,13.519c-7.388,5.321-15.762,11.353-15.762,20.68v8.012C0.067,190.874,3.978,193.746,7.63,193.746z"/><path d="M42.446,242.783c0-12.342-7.288-19.42-19.994-19.42c-16.66,0-21.062,11.898-21.062,18.189c0,7.324,5.445,8.115,7.786,8.115c4.559,0,7.621-3.063,7.621-7.622c0-1.754,0.624-3.767,5.487-3.767c3.495,0,4.918,0.504,4.918,5.568c0,4.948-1.062,5.487-5.245,5.487c-4.018,0-7.047,3.171-7.047,7.375c0,4.159,3.066,7.296,7.131,7.296c5.525,0,6.635,2.256,6.635,5.897v1.559c0,6.126-2.389,7.287-6.798,7.287c-6.083,0-6.556-3.132-6.556-4.092c0-3.631-2.407-7.295-7.785-7.295c-4.72,0-7.538,2.941-7.538,7.869c0,8.976,7.696,18.516,21.958,18.516c13.854,0,22.126-8.331,22.126-22.285v-1.559c0-5.721-1.83-10.465-5.264-13.876C41.171,252.622,42.446,248.081,42.446,242.783z"/></g></svg>
            <span>Planting Steps</span>
          </h2>

          <div id="steps-container" class="flex flex-col gap-3">
            <!-- Step 1 is rendered by JS on page load -->
          </div>

          {{-- BUG FIX: added type="button" to prevent accidental form submission --}}
          <button type="button" id="add-step-btn" class="border-2 border-dashed border-[#17CF5A]/30 rounded-lg text-[#17CF5A] flex justify-center items-center gap-2 font-semibold py-2">
            <svg class="h-5 w-5" viewBox="0 0 32 32" fill="currentColor"><path d="M480,1117 C472.268,1117 466,1110.73 466,1103 C466,1095.27 472.268,1089 480,1089 C487.732,1089 494,1095.27 494,1103 C494,1110.73 487.732,1117 480,1117 L480,1117 Z M480,1087 C471.163,1087 464,1094.16 464,1103 C464,1111.84 471.163,1119 480,1119 C488.837,1119 496,1111.84 496,1103 C496,1094.16 488.837,1087 480,1087 L480,1087 Z M486,1102 L481,1102 L481,1097 C481,1096.45 480.553,1096 480,1096 C479.447,1096 479,1096.45 479,1097 L479,1102 L474,1102 C473.447,1102 473,1102.45 473,1103 C473,1103.55 473.447,1104 474,1104 L479,1104 L479,1109 C479,1109.55 479.447,1110 480,1110 C480.553,1110 481,1109.55 481,1109 L481,1104 L486,1104 C486.553,1104 487,1103.55 487,1103 C487,1102.45 486.553,1102 486,1102 L486,1102 Z" transform="translate(-464, -1087)"/></svg>
            <span>Add Another Step</span>
          </button>
        </div>

      </div>

      <!-- Modal Footer -->
      <div class="p-6 flex gap-3 justify-center bg-[#F8FAFC] border-t border-[#E2E8F0] shrink-0">
        <button type="button" class="btn-form-close text-black px-4 py-2 rounded border border-[#CBD5E1]">
          Cancel
        </button>
        <button id="save-plant" type="button" class="bg-green-500 text-white px-4 py-2 rounded">
          Save Plant
        </button>
      </div>

    </form>
  </div>

  <script>
    // Modal open/close
    const plantFormContainer = document.getElementById('plant-form')
    const btnAddPlant = document.getElementById('add-plant-btn')

    btnAddPlant.addEventListener('click', () => {
      plantFormContainer.classList.remove('hidden')
    })

    document.querySelectorAll('.btn-form-close').forEach(btn => {
      btn.addEventListener('click', () => {
        plantFormContainer.classList.add('hidden')
      })
    })

    // Images
    const imgInput = document.getElementById('img-input')
    const imgPreview = document.getElementById('img-preview')
    const imgUrls = []   // tracks added URLs
    let imgCounter = 0    // unique id per preview card

    imgInput.addEventListener('keydown', (e) => {
      // trigger on Enter so the user knows when to confirm the URL
      if (e.key !== 'Enter') return
      e.preventDefault()
      addImage(imgInput.value.trim())
    })

    // also trigger on losing focus (blur) for convenience
    imgInput.addEventListener('blur', () => {
      addImage(imgInput.value.trim())
    })

    function addImage(url) {
      if (!url) return
      if (imgPreview.querySelectorAll('.img-card').length >= 5) {
        alert("Only 5 images allowed")
        imgInput.value = ''
        return
      }
      if (imgUrls.includes(url)) {
        imgInput.value = ''
        return
      }

      imgUrls.push(url)
      const id  = `img-${imgCounter++}`
      const div = document.createElement('div')
      div.className = "img-card relative aspect-square bg-slate-100 rounded-lg border border-slate-200 overflow-hidden group max-h-20"
      div.id = id
      div.innerHTML = `
        <img src="${url}" class="object-cover w-full h-full">
        <button type="button" onclick="removeImage('${id}', '${url}')"
          class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-0.5 shadow-md opacity-0 group-hover:opacity-100 transition-opacity">
          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M6 18L18 6M6 6l12 12" stroke-width="3"/>
          </svg>
        </button>
      `
      imgPreview.appendChild(div)
      imgInput.value = ''
    }

    function removeImage(id, url) {
      document.getElementById(id)?.remove()
      const idx = imgUrls.indexOf(url)
      if (idx > -1) imgUrls.splice(idx, 1)
    }

    // Planting Steps 
    const stepsContainer = document.getElementById('steps-container')
    let   stepCount      = 0

    function addStep() {
      stepCount++
      const div = document.createElement('div')
      div.className = "flex gap-3 items-start"
      div.id = `step-${stepCount}`
      div.innerHTML = `
        <span>
          <p class="h-7 w-7 text-center bg-[#17CF5A]/10 text-[#17CF5A] rounded-full leading-7">${stepCount}</p>
        </span>
        {{-- BUG FIX: added name="etapes[]" so steps are sent with the form --}}
        <textarea name="etapes[]" placeholder="Describe step ${stepCount}..."
          class="px-3 py-2 border border-[#E2E8F0] rounded-lg flex-1"></textarea>
        <button type="button" onclick="removeStep('step-${stepCount}')">
          <svg class="h-5 w-5 text-[#CBD5E1]" viewBox="0 0 32 32" fill="currentColor">
            <path d="M532,1117 C524.268,1117 518,1110.73 518,1103 C518,1095.27 524.268,1089 532,1089 C539.732,1089 546,1095.27 546,1103 C546,1110.73 539.732,1117 532,1117 Z M532,1087 C523.163,1087 516,1094.16 516,1103 C516,1111.84 523.163,1119 532,1119 C540.837,1119 548,1111.84 548,1103 C548,1094.16 540.837,1087 532,1087 Z M538,1102 L526,1102 C525.447,1102 525,1102.45 525,1103 C525,1103.55 525.447,1104 526,1104 L538,1104 C538.553,1104 539,1103.55 539,1103 C539,1102.45 538.553,1102 538,1102 Z" transform="translate(-516, -1087)"/>
          </svg>
        </button>
      `
      stepsContainer.appendChild(div)
    }

    function removeStep(id) {
      // don't allow removing the last step
      if (stepsContainer.children.length <= 1) return
      document.getElementById(id)?.remove()
      // re-number the remaining step badges
      Array.from(stepsContainer.children).forEach((el, i) => {
        el.querySelector('p').textContent = i + 1
      })
      stepCount = stepsContainer.children.length
    }

    document.getElementById('add-step-btn').addEventListener('click', addStep)

    // Start with step 1 already visible
    addStep()

    // Save (submit) 
    document.getElementById('save-plant').addEventListener('click', () => {
      if (imgUrls.length === 0) {
        alert("Please add at least one image URL")
        return
      }
      // Inject hidden inputs for each image URL before submitting
      imgUrls.forEach(url => {
        const input   = document.createElement('input')
        input.type    = 'hidden'
        input.name    = 'images[]'
        input.value   = url
        imgPreview.appendChild(input)
      })
      document.getElementById('add-plant-form').submit()
    })

    // Re-open modal if validation errors came back from the server
    @if($errors->any())
      plantFormContainer.classList.remove('hidden')
    @endif

    // Message hundeling
    const messages_container = document.getElementById('messages')
    setTimeout(() => {
      messages_container.innerHTML = ''
    }, 2000);
  </script>

</x-dashbord-layout>