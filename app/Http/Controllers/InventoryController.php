<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InventoryController extends Controller
{
    private $baseUrl = 'http://localhost:8080/toad/inventory/getStockByStore';

    public function index()
    {
        $response = Http::get("{$this->baseUrl}/all");

        if ($response->successful()) {
            $inventories = $response->json();
        } else {
            $inventories = [];
        }

        return view('inventory.index', compact('inventories'));
    }
}
