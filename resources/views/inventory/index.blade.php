<x-app-layout>
    <head>
        <style>
            /* Couleurs inspirées de Mario */
            :root {
                --mario-red: #e63946;
                --mario-blue: #1d3557;
                --mario-yellow: #f1faee;
                --mario-white: #ffffff;
                --mario-gray: #f1f1f1;
                --mario-light-gray: #dcdcdc;
            }

            /* Fond général et mise en page */
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: var(--mario-light-gray);
                color: var(--mario-blue);
                padding-top: 2rem;
            }

            /* Conteneur du tableau avec du padding et un ombrage pour l'effet 'cartoon' */
            .container {
                background-color: var(--mario-white);
                padding: 2rem;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                margin: 0 auto;
                max-width: 1200px;
            }

            /* Titre centré avec effet Mario */
            h1 {
                text-align: center;
                font-size: 2rem;
                font-weight: bold;
                color: var(--mario-red);
                margin-bottom: 1.5rem;
            }

            /* Table */
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 0 auto;
                text-align: left;
            }

            /* Style des en-têtes de table */
            th {
                padding: 10px;
                background-color: var(--mario-blue);
                color: var(--mario-yellow);
                font-size: 1.1rem;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            /* Style des cellules de table */
            td {
                padding: 10px;
                border-bottom: 1px solid var(--mario-gray);
            }

            /* Lignes du tableau */
            tbody tr:nth-child(odd) {
                background-color: var(--mario-light-gray);
            }

            tbody tr:hover {
                background-color: var(--mario-red);
                color: var(--mario-white);
                transition: background-color 0.3s ease;
            }

            /* Affichage des messages si aucun stock n'est disponible */
            p {
                text-align: center;
                color: var(--mario-gray);
                font-size: 1rem;
            }

            /* Pour l'effet de centrage */
            .center {
                margin: 0 auto;
                display: block;
                text-align: center;
            }

            /* Ajout d'une bordure douce et arrondie pour les éléments de tableau */
            table, th, td {
                border: 1px solid var(--mario-gray);
                border-radius: 4px;
            }

            /* Ombre douce pour les tableaux */
            table {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            /* Responsivité */
            @media (max-width: 768px) {
                table {
                    width: 100%;
                }

                th, td {
                    padding: 8px;
                }
            }
        </style>
    </head>

    <div class="container mx-auto p-8">
        @php
            $response = @file_get_contents('http://localhost:8080/toad/inventory/getStockByStore');
            $stocks = $response ? json_decode($response) : [];
        @endphp

        @if(count($stocks) > 0)
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left">Film</th>
                        <th class="px-4 py-2 text-left">Quantité</th>
                        <th class="px-4 py-2 text-left">Adresse</th>
                        <th class="px-4 py-2 text-left">District</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ isset($stock->title) ? $stock->title : 'Nom non défini' }}</td>
                            <td class="px-4 py-2">{{ isset($stock->quantity) ? $stock->quantity : 'Quantité non définie' }}</td>
                            <td class="px-4 py-2">{{ isset($stock->address) ? $stock->address : 'Adresse non définie' }}</td>
                            <td class="px-4 py-2">{{ isset($stock->district) ? $stock->district : 'District non défini' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-gray-500 mt-4">Aucun stock disponible.</p>
        @endif
    </div>
</x-app-layout>
