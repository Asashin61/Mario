@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-center text-gray-900 mb-8">Modifier un Film: {{ $film['title'] }}</h1>
        
        <form action="{{ route('films.update', $film['film_id']) }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-red-500 mx-auto">
            @csrf
            @method('PUT')

            <!-- Champ titre -->
            <div class="form-group mb-6 text-center">
                <label for="title" class="block text-lg font-medium text-gray-700">Titre</label>
                <input type="text" name="title" id="title" value="{{ old('title', $film['title']) }}" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ description -->
            <div class="form-group mb-6 text-center">
                <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">{{ old('description', $film['description']) }}</textarea>
            </div>

            <!-- Champ release_year -->
            <div class="form-group mb-6 text-center">
                <label for="release_year" class="block text-lg font-medium text-gray-700">Année de sortie</label>
                <input type="number" name="release_year" id="release_year" value="{{ old('release_year', $film['releaseYear']) }}" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ language_id (caché avec valeur récupérée) -->
            <input type="hidden" name="language_id" value="{{ $film['languageId'] }}">

            <!-- Champ rentalDuration -->
            <div class="form-group mb-6 text-center">
                <label for="rental_duration" class="block text-lg font-medium text-gray-700">Durée de location</label>
                <input type="number" name="rental_duration" id="rental_duration" value="{{ old('rental_duration', $film['rentalDuration']) }}" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ length -->
            <div class="form-group mb-6 text-center">
                <label for="length" class="block text-lg font-medium text-gray-700">Durée (en minutes)</label>
                <input type="number" name="length" id="length" value="{{ old('length', $film['length']) }}" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ rentalRate -->
            <div class="form-group mb-6 text-center">
                <label for="rentalRate" class="block text-lg font-medium text-gray-700">Tarif de location</label>
                <input type="number" name="rental_rate" id="rentalRate" value="{{ old('rental_rate', $film['rentalRate']) }}" step="0.01" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ replacementCost -->
            <div class="form-group mb-6 text-center">
                <label for="replacementCost" class="block text-lg font-medium text-gray-700">Coût de remplacement</label>
                <input type="number" name="replacement_cost" id="replacementCost" value="{{ old('replacement_cost', $film['replacementCost']) }}" step="0.01" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ rating -->
            <div class="form-group mb-6 text-center">
                <label for="rating" class="block text-lg font-medium text-gray-700">Note</label>
                <select name="rating" id="rating" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
                    <option value="G" {{ old('rating', $film['rating']) == 'G' ? 'selected' : '' }}>G</option>
                    <option value="PG" {{ old('rating', $film['rating']) == 'PG' ? 'selected' : '' }}>PG</option>
                    <option value="PG-13" {{ old('rating', $film['rating']) == 'PG-13' ? 'selected' : '' }}>PG-13</option>
                    <option value="R" {{ old('rating', $film['rating']) == 'R' ? 'selected' : '' }}>R</option>
                    <option value="NC-17" {{ old('rating', $film['rating']) == 'NC-17' ? 'selected' : '' }}>NC-17</option>
                </select>
            </div>

            <!-- Caractéristiques spéciales -->
            <div class="form-group mb-6 text-center">
                <label class="block text-lg font-medium text-gray-700">Caractéristiques spéciales</label>
                <div class="mt-2">
                    @foreach(['Trailers', 'Commentaries', 'Deleted Scenes', 'Behind the Scenes'] as $feature)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="special_features[]" value="{{ $feature }}" class="form-checkbox text-red-500 focus:ring-red-500" 
                                {{ in_array($feature, old('special_features', $film['special_features'])) ? 'checked' : '' }}>
                            {{ $feature }}
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Champs cachés supplémentaires -->
            <input type="hidden" name="last_update" id="lastUpdate">

            <div class="flex justify-center">
                <button type="submit"
                    class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>

    <script>
        // Générer automatiquement la date actuelle au format YYYY-MM-DD HH:MM:SS pour la mise à jour
        document.addEventListener("DOMContentLoaded", function () {
            let now = new Date();
            let formattedDate = now.getFullYear() + "-" +
                ("0" + (now.getMonth() + 1)).slice(-2) + "-" +
                ("0" + now.getDate()).slice(-2) + " " +
                ("0" + now.getHours()).slice(-2) + ":" +
                ("0" + now.getMinutes()).slice(-2) + ":" +
                ("0" + now.getSeconds()).slice(-2);
            
            document.getElementById("lastUpdate").value = formattedDate;
        });
    </script>
@endsection
