<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $credentials = $request->only('email', 'password');

    // Construire l'URL pour récupérer l'utilisateur
    $url = "http://localhost:8080/toad/customer/getByEmail?email=" . $credentials['email'];

    // Faire la requête HTTP
    $response = Http::get($url);
    $user = $response->json();

    // Vérifier si l'utilisateur existe
    if (!$user) {
        return back()->withErrors(['email' => 'Utilisateur non trouvé.']);
    }

    // Comparer les mots de passe (en tant que chaînes de caractères)
    if ((string) $credentials['password'] === (string) $user['password']) {
        // Stocker l'ID utilisateur en session
        session(['customerId' => $user['customerId']]);

        // Régénérer la session
        $request->session()->regenerate();

        // Rediriger vers la liste des films
        return redirect()->route('films.index')->with('customerId', $user['customerId']);
    }

    return back()->withErrors(['email' => 'Les informations de connexion sont incorrectes.']);
}

    
    


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
