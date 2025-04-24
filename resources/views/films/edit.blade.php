@extends('layouts.app')
<head>
    <link rel="stylesheet" href="{{ asset('css/edit.styles.css') }}">
</head>
@section('content')
<div class="container mx-auto p-6">
    <!-- Vérification de l'existence du film -->
    @if(!isset($film))
        <div class="text-red-500 text-center font-semibold">
            Erreur : Le film n'a pas pu être chargé.
        </div>
    @else
        <h1 class="text-3xl font-semibold text-center mb-8">Modifier le film : {{ $film['title'] }}</h1>

        <!-- Formulaire de modification -->
        <form action="{{ route('films.update', $film['filmId']) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Affichage des erreurs -->
            @if($errors->any())
                <div class="text-red-500 text-center font-semibold mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Champ titre -->
            <div class="mb-4">
                <label for="title" class="block">Titre</label>
                <input type="text" name="title" id="title" value="{{ old('title', $film['title']) }}" class="border p-2 w-full" required>
            </div>

            <!-- Champ description -->
            <div class="mb-4">
                <label for="description" class="block">Description</label>
                <textarea name="description" id="description" class="border p-2 w-full" required>{{ old('description', $film['description']) }}</textarea>
            </div>

            <!-- Champ année de sortie -->
            <div class="mb-4">
                <label for="releaseYear" class="block">Année de sortie</label>
                <input type="number" name="releaseYear" id="releaseYear" value="{{ old('releaseYear', $film['releaseYear']) }}" class="border p-2 w-full" required>
            </div>

            <!-- Champ durée de location -->
            <div class="mb-4">
                <label for="rentalDuration" class="block">Durée de location</label>
                <input type="number" name="rentalDuration" id="rentalDuration" value="{{ old('rentalDuration', $film['rentalDuration']) }}" class="border p-2 w-full" required>
            </div>

            <!-- Champ taux de location -->
            <div class="mb-4">
                <label for="rentalRate" class="block">Taux de location</label>
                <input type="number" name="rentalRate" id="rentalRate" value="{{ old('rentalRate', $film['rentalRate']) }}" class="border p-2 w-full" required>
            </div>

            <!-- Champ longueur -->
            <div class="mb-4">
                <label for="length" class="block">Longueur</label>
                <input type="number" name="length" id="length" value="{{ old('length', $film['length']) }}" class="border p-2 w-full" required>
            </div>

            <!-- Champ note -->
            <div class="mb-4">
                <label for="rating" class="block">Note</label>
                <select name="rating" id="rating" class="border p-2 w-full">
                    <option value="G" {{ old('rating', $film['rating']) == 'G' ? 'selected' : '' }}>G</option>
                    <option value="PG" {{ old('rating', $film['rating']) == 'PG' ? 'selected' : '' }}>PG</option>
                    <option value="PG-13" {{ old('rating', $film['rating']) == 'PG-13' ? 'selected' : '' }}>PG-13</option>
                    <option value="R" {{ old('rating', $film['rating']) == 'R' ? 'selected' : '' }}>R</option>
                    <option value="NC-17" {{ old('rating', $film['rating']) == 'NC-17' ? 'selected' : '' }}>NC-17</option>
                </select>
            </div>

            <!-- Champ languageId caché -->
            <input type="hidden" name="languageId" value="{{ old('languageId', $film['languageId']) }}">

            <input type="hidden" name="originalLanguageId" value="{{ old('originalLanguageId', $film['originalLanguageId']) }}">

            <!-- Champ last_update caché avec date actuelle au format requis -->
            <input type="hidden" name="lastUpdate" id="lastUpdate" value="{{ now()->format('Y-m-d H:i:s') }}">
            <input type="hidden" name="replacementCost" id="replacementCost" value="{{ old('replacementCost', $film['replacementCost']) }}" class="border p-2 w-full" required>

            <!-- Bouton de soumission visible tout le temps -->
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">
                    Mettre à jour
                </button>
            </div>
        </form>
    @endif
</div>

@endsection
