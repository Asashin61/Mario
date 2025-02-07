<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilmController extends Controller
{
    // Base URL de l'API
    private $baseUrl = 'http://localhost:8080/toad/film';

    public function index()
    {
        // Récupérer les films via l'API externe
        $response = Http::get("{$this->baseUrl}/all");
    
        // Vérifier si la requête a réussi
        if ($response->successful()) {
            $films = $response->json();
        } else {
            $films = [];  // Si l'API ne répond pas ou échoue
        }

        // Passer les films à la vue
        return view('films.index', compact('films'));  // Passer les films à la vue
    }
    public function search(Request $request)
    {
        // Récupérer la requête de recherche
        $query = $request->input('query');
        
        // Vérifier si une requête de recherche est présente
        if ($query) {
            // Utiliser l'API pour rechercher les films
            $response = Http::get("{$this->baseUrl}/search", [
                'query' => $query
            ]);
    
            // Vérifier si la requête a réussi
            if ($response->successful()) {
                $films = $response->json(); // Récupérer les films filtrés par le titre ou autre
            } else {
                $films = []; // Si l'API ne répond pas ou échoue
            }
        } else {
            // Si aucune recherche n'est effectuée, afficher tous les films
            $films = [];
        }
    
        // Retourner la vue avec les films filtrés ou d'un message de recherche vide
        return view('films.index', compact('films'));
    }
    /**
     * Ajouter un film
     */
    public function addFilm(Request $request)
    {
        $response = Http::post("{$this->baseUrl}/add", $request->only([
            'title', 'description', 'releaseYear', 'languageId', 'originalLanguageId', 
            'rentalDuration', 'rentalRate', 'length', 'replacementCost', 'rating', 
            'lastUpdate', 'idDirector'
        ]));

        return $response->json();
    }

    /**
     * Afficher les détails d'un film
     */
    public function show($id)
    {
        // Récupérer les détails du film via l'API
        $response = file_get_contents("http://localhost:8080/toad/film/getById?id={$id}");
        $film = json_decode($response);

        // Vérification si le film existe
        if (!$film) {
            abort(404, 'Film non trouvé.');
        }

        return view('films.show', compact('film'));
    }

    /**
     * Modifier un film
     */
 
     public function edit($filmId)
     {
         // Appel à l'API pour récupérer les informations du film
         $response = Http::get("{$this->baseUrl}/getById", ['id' => $filmId]);
     
         // Vérifier si l'appel a échoué
         if ($response->failed()) {
             return redirect()->route('films.index')->with('error', 'Erreur lors de la récupération du film.');
         }
     
         // Récupérer le film depuis la réponse de l'API
         $film = $response->json();
     
         // Si le film n'est pas trouvé, on redirige avec un message d'erreur
         if (!$film) {
             return redirect()->route('films.index')->with('error', 'Film introuvable.');
         }
     
         // Passer le film à la vue 'edit'
         return view('films.edit', compact('film'));
     }
     
     
     
     
     
     public function update(Request $request, $filmId)
     {
         // Validation des données de titre et de description
         $request->validate([
             'title' => 'required|string|max:255',
             'description' => 'required|string',
         ]);
     
         // Récupération des données nécessaires à partir de la requête
         $data = $request->only(['title', 'description']);
     
         // Appel de l'API pour mettre à jour le film avec les nouvelles informations
         $response = Http::put("{$this->baseUrl}/update/{$filmId}", $data);
     
         // Vérification de la réponse de l'API
         if ($response->failed()) {
             // Si la requête a échoué, renvoyer un message d'erreur
             return redirect()->back()->with('error', 'Erreur lors de la mise à jour du film.');
         }
     
         // Si la mise à jour a réussi, rediriger vers la page de détails du film avec un message de succès
         return redirect()->route('films.show', $filmId)->with('success', 'Film mis à jour avec succès.');
     }
     

    /**
     * Supprimer un film via un formulaire de suppression
     */
    public function destroy($filmId)
    {
        $response = Http::delete("http://localhost:8080/toad/film/delete/{$filmId}");

        if ($response->failed()) {
            return redirect()->route('films.index')->with('error', 'Erreur lors de la suppression du film.');
        }

        return redirect()->route('films.index')->with('success', 'Film supprimé avec succès.');
    }
    public function create()
{
    return view('films.create');
}

public function store(Request $request)
{
    // Valider les données du formulaire
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'releaseYear' => 'required|integer|min:1900|max:' . date('Y'),
        'languageId' => 'required|integer',
        'rentalRate' => 'required|numeric|min:0',
        'length' => 'required|integer|min:0',
        'rating' => 'required|string|max:5',
    ]);

    // Envoyer les données à l'API
    $response = Http::post("{$this->baseUrl}/add", $validatedData);

    // Vérifier si l'ajout a réussi
    if ($response->successful()) {
        return redirect()->route('films.index')->with('success', 'Film ajouté avec succès.');
    } else {
        return redirect()->back()->with('error', 'Erreur lors de l\'ajout du film.');
    }
}

    
}
