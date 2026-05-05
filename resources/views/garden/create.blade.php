<x-app-layout>
    <div class="w-full flex items-start justify-center bg-white p-2">

            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-green-50 border border-green-100 text-green-800 px-5 py-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-100 rounded-3xl shadow-sm py-6 px-8 w-1/2">
                <h1 class="text-2xl font-semibold text-gray-900">Create your own Garden</h1>
                <p class="mt-2 text-gray-600">Complet those garden informaions to start.</p>

                <form method="POST" action="{{ route('client.my-garden.store') }}" class="mt-4 space-y-3">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Garden's Name</label>
                        <input
                            type="text"
                            name="nom_jardin"
                            value="{{ old('nom_jardin', $jardin->nom_jardin ?? '') }}"
                            class="mt-1 p-1 w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500"
                            placeholder="Ex: Mon Jardin Tropical"
                        />
                        @error('nom_jardin')
                            <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Description</label>
                        <textarea
                            name="description_jardin"
                            rows="6"
                            class="mt-1 p-1 w-full rounded-lg border-gray-200 focus:ring-green-500 focus:border-green-500"
                            placeholder="Décrivez votre jardin..."
                        >{{ old('description_jardin', $jardin->description_jardin ?? '') }}</textarea>
                        @error('description_jardin')
                            <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-green-800 text-white font-bold py-3 rounded-xl hover:bg-green-900 transition">
                        Create Garden
                    </button>
                </form>
            </div>

    </div>
</x-app-layout>