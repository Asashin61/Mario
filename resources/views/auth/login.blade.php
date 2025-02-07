<x-guest-layout>
<head>
        <!-- Lier le fichier CSS -->
        <link rel="stylesheet" href="{{ asset('css/login.styles.css') }}">
    </head>
    <!-- Conteneur principal -->
    <div class="login-container">
        <!-- En-tête -->
        <div class="header">
            Bienvenue
        </div>

        <!-- Formulaire de connexion -->
        <form method="POST" action="{{ route('login') }}" class="form-container">
            @csrf

            <!-- Champ email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <input id="email" type="email" name="email" placeholder="Entrez votre email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Champ mot de passe -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <input id="password" type="password" name="password" placeholder="Votre mot de passe" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Case à cocher "Se souvenir de moi" -->
            <div class="remember-me">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span class="ms-2">{{ __('Se souvenir de moi') }}</span>
                </label>
            </div>

            <!-- Boutons et liens -->
            <div class="buttons">
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif

                <button type="submit">
                    {{ __('Connexion') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
