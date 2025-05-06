<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $envUrl = env('ENV_URL');
        $envPort = env('ENV_PORT');
        $endpointAllFilm ='/toad/inventory/getStockByStore';
        $data = $request->all();
        $response = Http::asForm()->get($envUrl.$envPort.$endpointAllFilm,$data);

        if ($response->successful()) {
            $stocks = $response->json();
        } else {
            $stocks = [];
        }

        return view('inventory.index', compact('stocks'));
    }

    public function destroy($filmId, Request $request)
{
    $envUrl = env('ENV_URL');   
    $envPort = env('ENV_PORT');
    $endpointDelete = '/toad/inventory/deleteDVD'; 
    $url = "{$envUrl}{$envPort}{$endpointDelete}/{$filmId}";

    $response = Http::delete($url);
    if ($response->failed()) {
        return redirect()
            ->route('inventory.index')
            ->with('error', 'Erreur lors de la suppression du DVD.');
    }

    // Ici on récupère simplement le texte renvoyé
    $message = $response->body();

    return redirect()
        ->route('inventory.index')
        ->with('success', $message);
}



public function store(Request $request)
{
    // URL de base de ton API
    $envUrl = env('ENV_URL');
    $envPort = env('ENV_PORT');
    $endpoint = '/toad/inventory/add';
    $lastUpdate = Carbon::now()->format('Y-m-d H:i:s');
    $data = $request->all();
    $data['last_update'] = $lastUpdate;
    // Récupérer les données du formulaire
    $response = Http::asForm()->post($envUrl.$envPort.$endpoint, $data);

    if ($response->successful()) {
        return redirect()->route('inventory.index')->with('success', 'Ajout d\'un stock ajouté avec succès.');
    } else {
        return back()->withErrors('Erreur lors de l\'ajout du stock')->withInput();
    }
}




public function create()
{
    $envUrl = env('ENV_URL');
    $envPort = env('ENV_PORT');
    $endpoint = '/toad/film/all';

    $response = Http::get($envUrl . $envPort . $endpoint);
    $films = $response->successful() ? $response->json() : [];
    return view('inventory.create', compact('films'));
}



}
