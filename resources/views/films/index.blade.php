<x-app-layout>
    <head>
        <!-- Lier le fichier CSS -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>

    <div class="container bg-mario-bg p-8 rounded-lg shadow-lg">
        @php
            // Récupération des films depuis l'API
            $response = @file_get_contents('http://localhost:8080/toad/film/all');
            $films = $response ? json_decode($response) : [];
        @endphp

        @if(isset($films) && count($films) > 0)
            <div class="space-y-6">
                <!-- Liste des films avec animation d'apparition -->
                @foreach($films as $film)
                    <div class="film-item bg-white p-4 rounded-lg shadow-md animate-fade-in">
                        <a href="{{ route('films.show', ['id' => $film->filmId]) }}" 
                           class="film-title text-xl font-semibold text-mario-red hover:text-white hover:bg-mario-blue transition duration-300 ease-in-out p-2 rounded-md">
                            {{ $film->title }}
                        </a>
                        <p class="text-gray-600">{{ $film->length }} minutes</p>

                        <div class="flex space-x-4 mt-4">
                            <!-- Bouton Modifier -->
                            <form action="{{ route('films.edit', ['id' => $film->filmId]) }}" method="GET">
                                <button type="submit" class="btn-modifier">Modifier</button>
                            </form>

                            <!-- Bouton Supprimer -->
                            <form action="{{ route('films.destroy', ['id' => $film->filmId]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce film ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-white text-center mt-4">Aucun film disponible à la vente.</p>
        @endif
    </div>
</x-app-layout>
