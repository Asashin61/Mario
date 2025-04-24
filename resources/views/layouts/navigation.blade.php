<nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('films.index') }}" class="text-white font-semibold text-2xl">RFTG</a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-4">
                    <x-nav-link :href="route('films.index')" :active="request()->routeIs('films.index')" class="text-white hover:bg-gray-700 rounded-lg px-3 py-2 hover:text-white">
                        {{ __('Films') }}
                    </x-nav-link>

                    <x-nav-link :href="route('films.create')" :active="request()->routeIs('films.create')" class="text-white hover:bg-gray-700 rounded-lg px-3 py-2 hover:text-white">
                        {{ __('Ajouter un Film') }}
                    </x-nav-link>

                    <x-nav-link :href="route('inventory.index')" :active="request()->routeIs('inventory.index')" class="text-white hover:bg-gray-700 rounded-lg px-3 py-2 hover:text-white">
                        {{ __('Stocks') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('inventory.create')" :active="request()->routeIs('inventory.create')" class="text-white hover:bg-gray-700 rounded-lg px-3 py-2 hover:text-white w-full">
                        {{ __('Ajout d\'un Stock') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Barre de recherche (visible uniquement sur films.index) -->
            <div class="flex items-center space-x-4 ml-auto {{ request()->routeIs('films.index') ? '' : 'hidden' }}">
                <form method="GET" action="{{ route('films.index') }}" class="flex space-x-2">
                    <input type="text" name="search" placeholder="Rechercher un film..." value="{{ request('search') }}" class="px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Rechercher
                    </button>
                </form>
            </div>

            <!-- Settings Dropdown -->
            <div class="flex justify-end items-center w-full">
                @if(Auth::check())
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-gray-800 hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profil') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-nav-link :href="route('login_staff')" class="text-white hover:bg-gray-700 rounded-lg px-3 py-2 hover:text-white">
                        {{ __('Déconnexion') }}
                    </x-nav-link>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('films.index')" :active="request()->routeIs('films.index')" class="hover:text-white">
                {{ __('Films') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('films.create')" :active="request()->routeIs('films.create')" class="hover:text-white">
                {{ __('Ajouter un Film') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('inventory.index')" :active="request()->routeIs('inventory.index')" class="hover:text-white">
                {{ __('Stocks') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @if(Auth::check())
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="hover:text-white">
                        {{ __('Profil') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login_staff')" class="hover:text-white">
                        {{ __('Déconnexion') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endif
    </div>
</nav>
