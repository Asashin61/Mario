@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Titre centré -->
        <h1 class="text-3xl font-semibold text-center text-gray-900 mb-8">Ajouter un Film</h1>
        
        <!-- Formulaire d'ajout du film -->
        <form action="{{ route('films.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-red-500 mx-auto">
            @csrf

            <!-- Champ titre -->
            <div class="form-group mb-6 text-center">
                <label for="title" class="block text-lg font-medium text-gray-700">Titre</label>
                <input type="text" name="title" id="title" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ description -->
            <div class="form-group mb-6 text-center">
                <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto"></textarea>
            </div>

            <!-- Bouton de soumission centré -->
            <div class="flex justify-center">
                <button type="submit"
                    class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Ajouter
                </button>
            </div>
        </form>
    </div>

    <!-- Style CSS intégré -->
    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }

        input, textarea {
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-size: 1rem;
            width: 100%;
        }

        input:focus, textarea:focus {
            border-color: #F87171; /* Couleur rouge */
            outline: none;
            box-shadow: 0 0 0 2px rgba(248, 113, 113, 0.5); /* Effet de focus rouge */
        }

        button {
            background-color: #F87171; /* Rouge */
            color: white;
            padding: 0.75rem 2rem;
            font-size: 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #F44336; /* Effet au survol - rouge plus intense */
        }

        button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.7);
        }
    </style>
@endsection
