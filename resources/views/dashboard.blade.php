<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Formulaire de recherche -->
            <div class="mb-6 bg-white shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('users.search') }}" method="GET" class="flex items-center space-x-2">
                    <div class="flex-1">
                        <input type="text" 
                               name="search" 
                               placeholder="Rechercher un utilisateur par pseudo ou email..." 
                               value="{{ request('search') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            
            <!-- Section Profil Utilisateur -->
            <div class="mt-6 bg-white shadow-lg rounded-lg p-6 flex items-center space-x-4">
                <!-- Photo de profil -->
                <div class="flex-shrink-0">
                    <img src="{{ auth()->user()->photo_url ?? asset('images/default-avatar.png') }}"
                         alt="Profile Photo"
                         class="w-16 h-16 rounded-full object-cover border-2 border-gray-300 shadow">
                </div>
                
                <!-- Informations utilisateur -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
                    <p class="text-gray-600">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <!-- Résultats de recherche (si disponibles) -->
            @if(isset($users) && $users->count() > 0)
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Résultats de recherche</h3>
                    <div class="space-y-4">
                        @foreach($users as $user)
                            <div class="bg-white shadow rounded-lg p-4 flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img src="{{ $user->photo_url ?? asset('images/default-avatar.png') }}"
                                         alt="{{ $user->name }}"
                                         class="w-12 h-12 rounded-full object-cover border border-gray-300">
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $user->name }}</h4>
                                    <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            @elseif(request('search'))
                <div class="mt-6 bg-white shadow rounded-lg p-6 text-center text-gray-500">
                    Aucun utilisateur trouvé pour "{{ request('search') }}"
                </div>
            @endif
        </div>
    </div>
</x-app-layout>