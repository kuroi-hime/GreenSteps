<x-dashbord-layout>
  <!-- Conteneur principal : h-screen (ou calc) + overflow-hidden pour figer la page -->
  <div class="flex flex-col gap-5 h-[calc(100vh-60px)] overflow-hidden">

    <!-- Header (Fixe) -->
    <div class="flex justify-between items-center shrink-0 px-1">
      <div class="flex flex-col gap-1">
        <h1 class="text-3xl font-bold text-slate-800">Edit Plant</h1>
        <p class="text-gray-500">Update the details for <span class="text-[#17CF5A] font-medium">{{ $plante->nom_commun }}</span></p>
      </div>
      <a href="{{ route('admin.plantes.index') }}"
         class="flex items-center gap-1 border border-[#CBD5E1] text-gray-600 px-4 py-2 rounded hover:bg-gray-50 transition shadow-sm bg-white">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        Back to Plants
      </a>
    </div>

    <!-- Formulaire (Scrollable) -->
    <form method="POST" action="{{ route('admin.plantes.update', $plante) }}" id="edit-plant-form" 
          class="flex-1 overflow-y-auto pr-2 custom-scrollbar">
      @csrf
      @method('put')

      <div class="flex flex-col gap-6 pb-10">

        <!-- Basic Informations -->
        <div class="bg-white rounded-[0.75rem] p-6 flex flex-col gap-4 shadow-sm border border-slate-100">
          <h2 class="flex gap-2 items-center text-[#17CF5A] font-semibold">
            <svg class="h-5 w-5" viewBox="0 0 512 512" fill="currentColor"><g transform="translate(42.666667, 42.666667)"><path d="M213.333333,3.55271368e-14 C330.943502,3.55271368e-14 426.666667,95.7231591 426.666667,213.333333 C426.666667,330.943502 330.943502,426.666667 213.333333,426.666667 C95.7231591,426.666667 3.55271368e-14,330.943502 3.55271368e-14,213.333333 C3.55271368e-14,95.7231591 95.7231591,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,42.6666667 C118.87459,42.6666667 42.6666667,118.87459 42.6666667,213.333333 C42.6666667,307.792077 118.87459,384 213.333333,384 C307.792077,384 384,307.792077 384,213.333333 C384,118.87459 307.792077,42.6666667 213.333333,42.6666667 Z M213.333333,272.042667 C228.571429,272.042667 240,283.306667 240,298.666667 C240,314.026667 228.571429,325.290667 213.333333,325.290667 C197.748918,325.290667 186.666667,314.026667 186.666667,298.325333 C186.666667,283.306667 198.095238,272.042667 213.333333,272.042667 Z M234.666667,85.3333333 L234.666667,234.666667 L192,234.666667 L192,85.3333333 L234.666667,85.3333333 Z" id="Combined-Shape"/></g></svg>
            Basic Informations
          </h2>

          <div>
            <label for="nom_commun" class="block mb-1 text-sm font-medium text-gray-700">Common Name</label>
            <input type="text" id="nom_commun" name="nom_commun" value="{{ old('nom_commun', $plante->nom_commun) }}" placeholder="e.g Tomato" class="w-full border border-[#E2E8F0] p-2 mb-1 rounded focus:outline-none focus:ring-2 focus:ring-[#17CF5A]/40">
            <x-input-error :messages="$errors->get('nom_commun')" class="mt-1" />
          </div>

          <div>
            <label for="nom_scientifique" class="block mb-1 text-sm font-medium text-gray-700">Scientific Name</label>
            <input type="text" id="nom_scientifique" name="nom_scientifique" value="{{ old('nom_scientifique', $plante->nom_scientifique) }}" placeholder="e.g. Solanum lycopersicum" class="w-full border border-[#E2E8F0] p-2 mb-1 rounded focus:outline-none focus:ring-2 focus:ring-[#17CF5A]/40">
            <x-input-error :messages="$errors->get('nom_scientifique')" class="mt-1" />
          </div>

          <div>
            <label for="description_plante" class="block mb-1 text-sm font-medium text-gray-700">Description</label>
            <textarea id="description_plante" name="description_plante" rows="3" placeholder="Brief description of the plant..." class="w-full border border-[#E2E8F0] p-2 mb-1 rounded focus:outline-none focus:ring-2 focus:ring-[#17CF5A]/40">{{ old('description_plante', $plante->description_plante) }}</textarea>
            <x-input-error :messages="$errors->get('description_plante')" class="mt-1" />
          </div>

          <div class="flex gap-3">
            <div class="w-full flex flex-col gap-1">
              <label for="categorie_id" class="text-sm font-medium text-gray-700">Category</label>
              <select id="categorie_id" name="categorie_id" class="w-full border border-[#E2E8F0] p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#17CF5A]/40">
                @foreach($categories as $categorie)
                  <option value="{{ $categorie->id }}" {{ old('categorie_id', $plante->categorie_id) == $categorie->id ? 'selected' : '' }}>{{ $categorie->nom_categorie }}</option>
                @endforeach
              </select>
              <x-input-error :messages="$errors->get('categorie_id')" class="mt-1" />
            </div>

            <div class="w-full flex flex-col gap-1">
              <label for="difficulte_plante" class="text-sm font-medium text-gray-700">Difficulty</label>
              <select id="difficulte_plante" name="difficulte_plante" class="w-full border border-[#E2E8F0] p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#17CF5A]/40">
                <option value="easy" {{ old('difficulte_plante', $plante->difficulte_plante) == 'easy' ? 'selected' : '' }}>Easy</option>
                <option value="medium" {{ old('difficulte_plante', $plante->difficulte_plante) == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="hard" {{ old('difficulte_plante', $plante->difficulte_plante) == 'hard' ? 'selected' : '' }}>Hard</option>
              </select>
              <x-input-error :messages="$errors->get('difficulte_plante')" class="mt-1" />
            </div>
          </div>
        </div>

        <!-- Care Requirements -->
        <div class="bg-white rounded-[0.75rem] p-6 flex flex-col gap-4 shadow-sm border border-slate-100">
          <h2 class="flex gap-2 items-center text-[#17CF5A] font-semibold">
            <svg class="h-5 w-5" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M41.5 10H35.5" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M27.5 6V14" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M27.5 10L5.5 10" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M13.5 24H5.5" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M21.5 20V28" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M43.5 24H21.5" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M41.5 38H35.5" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M27.5 34V42" stroke="currentColor" stroke-width="4" stroke-linecap="round"/><path d="M27.5 38H5.5" stroke="currentColor" stroke-width="4" stroke-linecap="round"/></svg>
            Care Requirements
          </h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col gap-2 p-3 bg-[#F8FAFC] rounded-lg border border-slate-100">
              <label class="flex gap-2 items-center text-sm font-medium text-gray-700">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none"><path d="M7.5 2.25V0H9V2.25H7.5ZM7.5 16.5V14.25H9V16.5H7.5ZM14.25 9V7.5H16.5V9H14.25ZM0 9V7.5H2.25V9H0ZM13.275 4.275L12.225 3.225L13.5375 1.875L14.625 2.9625L13.275 4.275ZM2.9625 14.625L1.875 13.5375L3.225 12.225L4.275 13.275L2.9625 14.625ZM13.5375 14.625L12.225 13.275L13.275 12.225L14.625 13.5375L13.5375 14.625ZM3.225 4.275L1.875 2.9625L2.9625 1.875L4.275 3.225L3.225 4.275ZM8.25 12.75C7 12.75 5.9375 12.3125 5.0625 11.4375C4.1875 10.5625 3.75 9.5 3.75 8.25C3.75 7 4.1875 5.9375 5.0625 5.0625C5.9375 4.1875 7 3.75 8.25 3.75C9.5 3.75 10.5625 4.1875 11.4375 5.0625C12.3125 5.9375 12.75 7 12.75 8.25C12.75 9.5 12.3125 10.5625 11.4375 11.4375C10.5625 12.3125 9.5 12.75 8.25 12.75ZM8.25 11.25C9.0875 11.25 9.79688 10.9594 10.3781 10.3781C10.9594 9.79688 11.25 9.0875 11.25 8.25C11.25 7.4125 10.9594 6.70312 10.3781 6.12187C9.79688 5.54062 9.0875 5.25 8.25 5.25C7.4125 5.25 6.70312 5.54062 6.12187 6.12187C5.54062 6.70312 5.25 7.4125 5.25 8.25C5.25 9.0875 5.54062 9.79688 6.12187 10.3781C6.70312 10.9594 7.4125 11.25 8.25 11.25Z" fill="#EAB308"/></svg>
                Sunlight
              </label>
              <select name="sunlight_plante" class="w-full border border-[#E2E8F0] p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#17CF5A]/40">
                <option value="full sun" {{ old('sunlight_plante', $plante->sunlight_plante) == 'full sun' ? 'selected' : '' }}>Full Sun</option>
                <option value="partial shade" {{ old('sunlight_plante', $plante->sunlight_plante) == 'partial shade' ? 'selected' : '' }}>Partial Shade</option>
                <option value="full shade" {{ old('sunlight_plante', $plante->sunlight_plante) == 'full shade' ? 'selected' : '' }}>Full Shade</option>
              </select>
            </div>

            <div class="flex flex-col gap-2 p-3 bg-[#F8FAFC] rounded-lg border border-slate-100">
              <label class="flex gap-2 items-center text-sm font-medium text-gray-700">
                <svg width="12" height="15" viewBox="0 0 12 15" fill="none"><path d="M6.20625 12.75C6.35625 12.7375 6.48438 12.6781 6.59062 12.5719C6.69687 12.4656 6.75 12.3375 6.75 12.1875C6.75 12.0125 6.69375 11.8719 6.58125 11.7656C6.46875 11.6594 6.325 11.6125 6.15 11.625C5.6375 11.6625 5.09375 11.5219 4.51875 11.2031C3.94375 10.8844 3.58125 10.3062 3.43125 9.46875C3.40625 9.33125 3.34063 9.21875 3.23438 9.13125C3.12812 9.04375 3.00625 9 2.86875 9C2.69375 9 2.55 9.06562 2.4375 9.19687C2.325 9.32812 2.2875 9.48125 2.325 9.65625C2.5375 10.7937 3.0375 11.6062 3.825 12.0938C4.6125 12.5813 5.40625 12.8 6.20625 12.75ZM6 15C4.2875 15 2.85938 14.4125 1.71563 13.2375C0.571875 12.0625 0 10.6 0 8.85C0 7.6 0.496875 6.24062 1.49063 4.77187C2.48438 3.30312 3.9875 1.7125 6 0C8.0125 1.7125 9.51562 3.30312 10.5094 4.77187C11.5031 6.24062 12 7.6 12 8.85C12 10.6 11.4281 12.0625 10.2844 13.2375C9.14062 14.4125 7.7125 15 6 15ZM6 13.5C7.3 13.5 8.375 13.0594 9.225 12.1781C10.075 11.2969 10.5 10.1875 10.5 8.85C10.5 7.9375 10.1219 6.90625 9.36563 5.75625C8.60938 4.60625 7.4875 3.35 6 1.9875C4.5125 3.35 3.39062 4.60625 2.63438 5.75625C1.87813 6.90625 1.5 7.9375 1.5 8.85C1.5 10.1875 1.925 11.2969 2.775 12.1781C3.625 13.0594 4.7 13.5 6 13.5Z" fill="#3B82F6"/></svg>
                Watering frequency
              </label>
              <input type="number" name="frequence_arrosage" min="0" value="{{ old('frequence_arrosage', $plante->frequence_arrosage) }}" placeholder="Days" class="w-full border border-[#E2E8F0] p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#17CF5A]/40">
            </div>

            <div class="flex flex-col gap-2 p-3 bg-[#F8FAFC] rounded-lg border border-slate-100">
              <label class="flex gap-2 items-center text-sm font-medium text-gray-700">
                <span class="material-symbols-outlined text-red-500 text-lg">thermometer</span>
                Temp (Min - Max)
              </label>
              <div class="flex items-center gap-2">
                <input type="number" name="min_temp_plante" step="0.01" value="{{ old('min_temp_plante', $plante->min_temp_plante) }}" placeholder="Min" class="w-full border border-[#E2E8F0] p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#17CF5A]/40">
                <span>-</span>
                <input type="number" name="max_temp_plante" step="0.01" value="{{ old('max_temp_plante', $plante->max_temp_plante) }}" placeholder="Max" class="w-full border border-[#E2E8F0] p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#17CF5A]/40">
              </div>
            </div>

            <div class="flex flex-col gap-2 p-3 bg-[#F8FAFC] rounded-lg border border-slate-100">
              <label class="flex gap-2 items-center text-sm font-medium text-gray-700">
                <span class="material-symbols-outlined text-green-500 text-lg">straighten</span>
                Height (cm)
              </label>
              <input type="number" name="height_plante" min="0" step="0.01" value="{{ old('height_plante', $plante->height_plante) }}" class="w-full border border-[#E2E8F0] p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#17CF5A]/40">
            </div>
          </div>
        </div>

        <!-- Plant Photos -->
        <div class="bg-white rounded-[0.75rem] p-6 flex flex-col gap-4 shadow-sm border border-slate-100">
          <h2 class="flex gap-2 items-center text-[#17CF5A] font-semibold">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Plant Photos
          </h2>
          <input type="text" id="img-input" class="w-full border border-[#E2E8F0] p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#17CF5A]/40" placeholder="Paste an image URL then press Enter"/>
          <div id="img-preview" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 mt-2"></div>
        </div>

        <!-- Planting Steps -->
        <div class="bg-white rounded-[0.75rem] p-6 flex flex-col gap-4 shadow-sm border border-slate-100">
          <h2 class="flex gap-2 items-center text-[#17CF5A] font-semibold">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 317.109 317.109"><g><path d="M102.109,53.555h200c8.284,0,15-6.716,15-15s-6.716-15-15-15h-200c-8.284,0-15,6.716-15,15S93.825,53.555,102.109,53.555z"/><path d="M302.109,143.555h-200c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15C317.109,150.27,310.394,143.555,302.109,143.555z"/><path d="M302.109,263.555h-200c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15C317.109,270.271,310.394,263.555,302.109,263.555z"/></g></svg>
            Planting Steps
          </h2>
          <div id="steps-container" class="flex flex-col gap-4"></div>
          <button type="button" id="add-step-btn" class="border-2 border-dashed border-[#17CF5A]/30 rounded-lg text-[#17CF5A] flex justify-center items-center gap-2 font-semibold py-3 hover:bg-[#17CF5A]/5 transition">
            <span class="material-symbols-outlined">add_circle</span> Add Another Step
          </button>
        </div>

        <!-- Action Buttons (Bottom) -->
        <div class="flex gap-3 justify-end items-center mt-4">
          <a href="{{ route('admin.plantes.index') }}" class="text-gray-600 px-8 py-2.5 rounded-lg border border-[#CBD5E1] bg-white hover:bg-gray-50 transition font-medium">Cancel</a>
          <button type="button" id="save-plant" class="bg-[#17CF5A] hover:bg-[#15b34e] text-white px-8 py-2.5 rounded-lg transition flex items-center gap-2 font-bold shadow-lg shadow-green-500/20">
            <span class="material-symbols-outlined text-sm">save</span> Save Changes
          </button>
        </div>

      </div>
    </form>
  </div>

  <style>
    /* Scrollbar personnalisée pour ne pas dénaturer le design */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #17CF5A; }
  </style>

  <script>
    // --- IMAGES ---
    const imgInput = document.getElementById('img-input'), imgPreview = document.getElementById('img-preview'), imgUrls = [];
    let imgCounter = 0;
    const existingImages = @json($plante->images->pluck('url'));
    existingImages.forEach(url => addImage(url));

    imgInput.addEventListener('keydown', (e) => { if (e.key === 'Enter') { e.preventDefault(); addImage(imgInput.value.trim()); }});
    function addImage(url) {
      if (!url || imgUrls.includes(url) || imgUrls.length >= 5) { imgInput.value = ''; return; }
      imgUrls.push(url);
      const id = `img-${imgCounter++}`, div = document.createElement('div');
      div.className = "img-card relative aspect-square bg-slate-100 rounded-lg border border-slate-200 overflow-hidden group shadow-sm";
      div.id = id;
      div.innerHTML = `<img src="${url}" class="object-cover w-full h-full"><button type="button" onclick="removeImage('${id}', '${url}')" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 shadow-md opacity-0 group-hover:opacity-100 transition-opacity"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="3"/></svg></button>`;
      imgPreview.appendChild(div); imgInput.value = '';
    }
    function removeImage(id, url) { document.getElementById(id)?.remove(); const idx = imgUrls.indexOf(url); if (idx > -1) imgUrls.splice(idx, 1); }

    // --- STEPS ---
    const stepsContainer = document.getElementById('steps-container');
    let stepCount = 0;
    function addStep(value = '') {
      stepCount++;
      const div = document.createElement('div');
      div.className = "flex gap-3 items-start bg-slate-50 p-3 rounded-lg border border-slate-100";
      div.id = `step-${stepCount}`;
      div.innerHTML = `<span class="shrink-0 mt-1"><p class="h-6 w-6 text-xs flex items-center justify-center bg-[#17CF5A] text-white rounded-full font-bold">${stepCount}</p></span>
        <textarea name="etapes[]" placeholder="Describe step..." class="px-3 py-2 border border-[#E2E8F0] rounded-lg flex-1 focus:outline-none focus:ring-2 focus:ring-[#17CF5A]/40 text-sm" rows="2">${value}</textarea>
        <button type="button" class="mt-2" onclick="removeStep('${div.id}')"><span class="material-symbols-outlined text-gray-400 hover:text-red-500 transition">delete</span></button>`;
      stepsContainer.appendChild(div);
    }
    function removeStep(id) {
      if (stepsContainer.children.length <= 1) return;
      document.getElementById(id)?.remove();
      Array.from(stepsContainer.children).forEach((el, i) => { el.querySelector('p').textContent = i + 1; });
      stepCount = stepsContainer.children.length;
    }
    document.getElementById('add-step-btn').addEventListener('click', () => addStep());
    const existingSteps = @json($plante->etapes->sortBy('ordre')->pluck('description'));
    if (existingSteps.length > 0) existingSteps.forEach(desc => addStep(desc)); else addStep();

    // --- SAVE ---
    document.getElementById('save-plant').addEventListener('click', () => {
      imgUrls.forEach(url => {
        const input = document.createElement('input'); input.type = 'hidden'; input.name = 'images[]'; input.value = url;
        document.getElementById('edit-plant-form').appendChild(input);
      });
      document.getElementById('edit-plant-form').submit();
    });
  </script>
</x-dashbord-layout>