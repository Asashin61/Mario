@extends('layouts.app')

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
        <form action="{{ route('films.update', $film['film_id']) }}" method="POST">
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
                <label for="release_year" class="block">Année de sortie</label>
                <input type="number" name="release_year" id="release_year" value="{{ old('release_year', $film['release_year']) }}" class="border p-2 w-full" required>
            </div>

            <!-- Champ durée de location -->
            <div class="mb-4">
                <label for="rental_duration" class="block">Durée de location</label>
                <input type="number" name="rental_duration" id="rental_duration" value="{{ old('rental_duration', $film['rental_duration']) }}" class="border p-2 w-full" required>
            </div>

            <!-- Champ taux de location -->
            <div class="mb-4">
                <label for="rental_rate" class="block">Taux de location</label>
                <input type="number" name="rental_rate" id="rental_rate" value="{{ old('rental_rate', $film['rental_rate']) }}" class="border p-2 w-full" required>
            </div>

            <!-- Champ longueur -->
            <div class="mb-4">
                <label for="length" class="block">Longueur</label>
                <input type="number" name="length" id="length" value="{{ old('length', $film['length']) }}" class="border p-2 w-full" required>
            </div>

            <!-- Champ coût de remplacement -->
            <div class="mb-4">
                <label for="replacement_cost" class="block">Coût de remplacement</label>
                <input type="number" name="replacement_cost" id="replacement_cost" value="{{ old('replacement_cost', $film['replacement_cost']) }}" class="border p-2 w-full" required>
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

            <!-- Bouton de soumission -->
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">
                    Mettre à jour
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
