@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-center text-gray-900 mb-8">Ajouter un Inventaire</h1>
        
        <form action="{{ route('inventory.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-red-500 mx-auto" onsubmit="updateTimestamp()">
            @csrf

            <!-- Champ film_id (sélection par titre) -->
            <div class="form-group mb-6 text-center">
                <label for="film_id" class="block text-lg font-medium text-gray-700">Titre du Film</label>
                <select name="film_id" id="film_id" required
                        class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
                    <option value="">-- Choisir un film --</option>
                    @foreach($films as $film)
                        <option value="{{ $film['filmId'] }}">{{ $film['title'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Champ store_id -->
            <div class="form-group mb-6 text-center">
                <label for="store_id" class="block text-lg font-medium text-gray-700">ID du Magasin</label>
                <input type="number" name="store_id" id="store_id" value="{{ old('store_id') }}" required
                       class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ last_update en hidden -->
            <input type="hidden" name="LastUpdate" id="last_update" value="">

            <div class="flex justify-center">
                <button type="submit"
                        class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Ajouter l'Inventaire
                </button>
            </div>
        </form>
    </div>

    <!-- Script pour remplir le champ LastUpdate -->
    <script>
        function updateTimestamp() {
            const now = new Date();
            const formatted = now.toISOString().slice(0, 19).replace('T', ' ');
            document.getElementById('last_update').value = formatted;
        }
    </script>
@endsection
