@extends('layouts.app')
<head>
        <link rel="stylesheet" href="{{ asset('css/create.styles.css') }}">
    </head>
@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-center text-gray-900 mb-8">Ajouter un Film</h1>
        
        <form action="{{ route('films.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-red-500 mx-auto">
            @csrf

            <!-- Champ titre -->
            <div class="form-group mb-6 text-center">
                <label for="title" class="block text-lg font-medium text-gray-700">Titre</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ description -->
            <div class="form-group mb-6 text-center">
                <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">{{ old('description') }}</textarea>
            </div>

            <!-- Champ release_year -->
            <div class="form-group mb-6 text-center">
                <label for="releaseYear" class="block text-lg font-medium text-gray-700">Année de sortie</label>
                <input type="number" name="releaseYear" id="releaseYear" value="{{ old('releaseYear') }}" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champs cachés -->
            <input type="hidden" name="languageId" value="{{ old('language_id', 1) }}">
            <input type="hidden" name="originalLanguageId" value="{{ old('originalLanguageId', 1) }}">
            <input type="hidden" name="rentalRate" value="{{ old('rentalRate', 4.99) }}">
            <input type="hidden" name="replacementCost" value="{{ old('replacementCost', 19.99) }}">
            <input type="hidden" name="lastUpdate" id="lastUpdate">

            <!-- Champ rentalDuration -->
            <div class="form-group mb-6 text-center">
                <label for="rentalDuration" class="block text-lg font-medium text-gray-700">Durée de location</label>
                <input type="number" name="rentalDuration" id="rentalDuration" value="{{ old('rentalDuration') }}" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ length -->
            <div class="form-group mb-6 text-center">
                <label for="length" class="block text-lg font-medium text-gray-700">Durée (en minutes)</label>
                <input type="number" name="length" id="length" value="{{ old('length') }}" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ rating -->
            <div class="form-group mb-6 text-center">
                <label for="rating" class="block text-lg font-medium text-gray-700">Note</label>
                <select name="rating" id="rating" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
                    <option value="G" {{ old('rating') == 'G' ? 'selected' : '' }}>G</option>
                    <option value="PG" {{ old('rating') == 'PG' ? 'selected' : '' }}>PG</option>
                    <option value="PG-13" {{ old('rating') == 'PG-13' ? 'selected' : '' }}>PG-13</option>
                    <option value="R" {{ old('rating') == 'R' ? 'selected' : '' }}>R</option>
                    <option value="NC-17" {{ old('rating') == 'NC-17' ? 'selected' : '' }}>NC-17</option>
                </select>
            </div>

            <!-- Caractéristiques spéciales -->
            <div class="form-group mb-6 text-center">
                <label class="block text-lg font-medium text-gray-700">Caractéristiques spéciales</label>
                <div class="mt-2">
                    @foreach(['Trailers', 'Commentaries', 'Deleted Scenes', 'Behind the Scenes'] as $feature)
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="special_features[]" value="{{ $feature }}" class="form-checkbox text-red-500 focus:ring-red-500" 
                                {{ in_array($feature, old('special_features', [])) ? 'checked' : '' }}>
                            {{ $feature }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Ajouter
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
