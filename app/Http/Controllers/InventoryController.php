<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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
            $inventories = $response->json();
        } else {
            $inventories = [];
        }

        return view('inventory.index', compact('inventories'));
    }
    public function destroy($inventoryId)
{
    $response = Http::delete("http://localhost:8080/toad/inventory/delete/{$inventoryId}");

    if ($response->successful()) {
        return redirect()->route('inventory.index')->with('success', 'Inventaire supprimé avec succès.');
    } else {
        return redirect()->route('inventory.index')->with('error', 'Échec de la suppression de l\'inventaire.');
    }
}
public function store(Request $request)
{
    // Récupérer les données du formulaire
    $filmTitle = $request->input('filmTitle');
    $quantity = $request->input('quantity');
    $address = $request->input('address');
    $district = $request->input('district');

    // URL de base de ton API
    $envUrl = env('ENV_URL');
    $envPort = env('ENV_PORT');
    $endpoint = '/toad/inventory/addStock';

    // Créer les données à envoyer à l'API
    $data = [
        'filmTitle' => $filmTitle,
        'quantity' => $quantity,
        'address' => $address,
        'district' => $district,
    ];

    // Envoi de la requête à ton API pour ajouter un stock
    $response = Http::asForm()->post($envUrl . $envPort . $endpoint, $data);

    // Si la réponse est réussie, redirige l'utilisateur
    if ($response->successful()) {
        return redirect()->route('inventory.index')->with('success', 'Stock ajouté avec succès.');
    } else {
        // Si l'ajout échoue, retourne une erreur
        return back()->withErrors('Erreur lors de l\'ajout du stock.')->withInput();
    }
}




public function create()
{
    return view('inventory.create');
}



}
