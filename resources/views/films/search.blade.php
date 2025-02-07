@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Résultats de recherche</h1>
    
    <form action="{{ route('films.search') }}" method="GET">
        <input type="text" name="query" value="{{ old('query', $query) }}" placeholder="Rechercher un film..." class="form-control">
        <button type="submit" class="btn btn-primary mt-2">Rechercher</button>
    </form>
    
    @if(!empty($filteredFilms))
        <ul class="list-group mt-4">
            @foreach($filteredFilms as $film)
                <li class="list-group-item">
                    <h5>{{ $film['title'] }}</h5>
                    <p>{{ $film['description'] }}</p>
                    <small><strong>Année :</strong> {{ $film['releaseYear'] }} | <strong>Note :</strong> {{ $film['rating'] }}</small>
                </li>
            @endforeach
        </ul>
    @else
        <p class="mt-4">Aucun film trouvé pour "{{ $query }}".</p>
    @endif
</div>
@endsection
