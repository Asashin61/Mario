<x-app-layout>
    <div class="film-details-container">
        <h1 class="text-center film-title">Détails du Film</h1>
        <link rel="stylesheet" href="{{ asset('css/show.styles.css') }}">
        @if($film)
            <div class="film-grid">
                <div class="film-info">
                    <!-- Titre du film -->
                    <div class="film-info-item">
                        <span class="label">Titre :</span> {{ $film->title }}
                    </div>

                    <!-- Description du film -->
                    <div class="film-info-item">
                        <span class="label">Description :</span> {{ $film->description }}
                    </div>

                    <!-- Année de sortie -->
                    <div class="film-info-item">
                        <span class="label">Année de sortie :</span> {{ $film->releaseYear }}
                    </div>

                    <!-- Durée de location -->
                    <div class="film-info-item">
                        <span class="label">Durée de location :</span> {{ $film->rentalDuration }} jours
                    </div>

                    <!-- Durée du film -->
                    <div class="film-info-item">
                        <span class="label">Durée :</span> {{ $film->length }} minutes
                    </div>

                    <div class="film-info-item">
                        <span class="label">Nombre d'exemplaires total:</span>
                        @foreach($stockFilm as $stock)
                            <div>
                                Magasin {{ $stock->storeId }}: {{ $stock->nombreExemplaire }} exemplaires
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Image du film (si disponible) -->
                <div class="film-image">
                    <img src="https://via.placeholder.com/150" alt="Image du film" class="film-image-img">
                </div>
            </div>

            <!-- FilmId caché -->
            <input type="hidden" name="filmId" value="{{ $film->filmId }}">

            <!-- Bouton Retour à la page d'accueil -->
            <div class="mt-6 text-center">
                <a href="{{ route('films.index') }}" class="back-button">
                    Retour à l'accueil
                </a>
            </div>
        @else
            <p class="text-red-500 text-center">Film non trouvé.</p>
        @endif
    </div>
</x-app-layout>
