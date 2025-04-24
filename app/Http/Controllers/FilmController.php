<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class FilmController extends Controller
{
    // Base URL de l'API

    public function index(Request $request)
{
    $envUrl = env('ENV_URL');
    $envPort = env('ENV_PORT');
    $endpoint = '/toad/film/all';
    $data = $request->all();
    $response = Http::get($envUrl . $envPort . $endpoint, $data);

        if ($response->successful()) {
            $films = $response->json();
        }

    return view('films.index',compact('films'));
}




    // public function search(Request $request)
    // {
    // }
    // // /**
    // //  * Ajouter un film
    // //  */
    // // public function addFilm(Request $request)
    // // {
    // //     $response = Http::post("{$this->baseUrl}/add", $request->only([
    // //         'title', 'description', 'releaseYear', 'languageId', 'originalLanguageId', 
    // //          'rentalDuration', 'rentalRate', 'length', 'replacementCost', 'rating', 
    // //         'lastUpdate'
    // //     ]));

    // //     return $response->json();
    // // }
    
    public function store(Request $request)
    {
        $envUrl = env('ENV_URL');
        $envPort = env('ENV_PORT');
        $endpointStoreFilm ='/toad/film/add';
        $lastUpdate = Carbon::now()->format('Y-m-d H:i:s');
        $data = $request->all();
        $data['LastUpdate'] = $lastUpdate;
        // Récupérer les données du formulaire
        $response = Http::asForm()->post($envUrl.$envPort.$endpointStoreFilm, $data);
    
        if ($response->successful()) {
            return redirect()->route('films.index')->with('success', 'Film ajouté avec succès.');
        } else {
            return back()->withErrors('Erreur lors de l\'ajout du film.')->withInput();
        }
    }
    
    


    /**
     * Afficher les détails d'un film
     */
    public function show($id, Request $request)
{
    $envUrl = env('ENV_URL');
    $envPort = env('ENV_PORT');
    $endpointDetailFilm = '/toad/film/getById';
    $data = $request->all();

    // Correction de la concaténation de l'URL pour la requête API
    $response = Http::get($envUrl . $envPort . $endpointDetailFilm, ['id' => $id, $data]);
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
 
     public function edit($filmId, Request $request)
     {
        $envUrl = env('ENV_URL');
        $envPort = env('ENV_PORT');
        $endpointEditFilm = '/toad/film/getById';
        $data = $request->all();
        $response = Http::get($envUrl . $envPort . $endpointEditFilm, ['id' => $filmId, $data]);
         // Vérifier si l'appel a échoué
        if ($response->failed()) {
             return redirect()->route('films.index')->with('error', 'Erreur lors de la récupération du film.');
         }
        $film = $response->json();
 
         if (!$film) {
             return redirect()->route('films.index')->with('error', 'Film introuvable.');
         }
     
         // Passer le film à la vue 'edit'
         return view('films.edit', compact('film'));
     }
     
     
     public function update(Request $request, $filmId)
     {
        $envUrl = env('ENV_URL');
        $envPort = env('ENV_PORT');
        $endpointUpdateFilm ='/toad/film/update/';
        $lastUpdate = Carbon::now()->format('Y-m-d H:i:s');
        $data = $request->all();
        $data['LastUpdate'] = $lastUpdate;
        $response = Http::asForm()->put($envUrl.$envPort.$endpointUpdateFilm.$filmId, $data);
         if ($response->successful()) {
             return redirect()->route('films.index')->with('success', 'Film mis à jour avec succès.');
         } else {
            Log::error('Erreur lors de la mise à jour du film: ' . $response->body());
            return back()->withErrors('Erreur lors de la mise à jour du film.')->withInput();
         }
     }
     
     

    /**
     * Supprimer un film via un formulaire de suppression
     */
    public function destroy($filmId, Request $request)
    {
        $envUrl = env('ENV_URL');
        $envPort = env('ENV_PORT');
        $endpointDeleteFilm ='/toad/film/delete';
        $data = $request->all();
        $response = Http::delete($envUrl.$envPort.$endpointDeleteFilm.$filmId, $data);

        if ($response->failed()) {
            Log::error('Erreur lors de la suppression du film: ' . $response->body());
            return redirect()->route('films.index')->with('error', 'Erreur lors de la suppression du film.');
        }

        return redirect()->route('films.index')->with('success', 'Film supprimé avec succès.');
    }
    public function create()
{
    return view('films.create');
}
// public function getCategories($id, Request $request)
// {
//     $envUrl = env('ENV_URL');
//     $envPort = env('ENV_PORT');
//     $endpointCategoryFilm = '/toad/category/film/getById';
//     $data = $request->all();

//     $response = Http::get($envUrl . $envPort . $endpointCategoryFilm, ['id' => $id, $data]);

//     $film = json_decode($response);
//     if ($response->successful()) {
//         return $response->json();
//     }

//     return [];
// }



    
}
