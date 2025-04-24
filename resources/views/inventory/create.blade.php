@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-center text-gray-900 mb-8">Ajouter un Stock</h1>
        
        <form action="{{ route('inventory.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-red-500 mx-auto">
            @csrf

            <!-- Champ titre du film -->
            <div class="form-group mb-6 text-center">
                <label for="filmTitle" class="block text-lg font-medium text-gray-700">Titre du Film</label>
                <input type="text" name="filmTitle" id="filmTitle" value="{{ old('filmTitle') }}" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ quantité -->
            <div class="form-group mb-6 text-center">
                <label for="quantity" class="block text-lg font-medium text-gray-700">Quantité</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ adresse -->
            <div class="form-group mb-6 text-center">
                <label for="address" class="block text-lg font-medium text-gray-700">Adresse</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <!-- Champ district -->
            <div class="form-group mb-6 text-center">
                <label for="district" class="block text-lg font-medium text-gray-700">District</label>
                <input type="text" name="district" id="district" value="{{ old('district') }}" required
                    class="mt-2 block w-full max-w-2xl px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 mx-auto">
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Ajouter
                </button>
            </div>
        </form>
    </div>
@endsection
