<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titre }}</title> {{-- Récupère le nom de l'application dans le fichier .env --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/index.css', 'resources/js/index.js'])
</head>
<body class="body-styles">
    {{-- Conteneur global --}}
    <div class="container">
        {{-- Header --}}
        <header class="header">
            {{-- Logo --}}
            <a href="{{ route('indexinvite') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="logo">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                </svg>
            </a>
            {{-- Formulaire de recherche --}}
            <form action="{{ route('index') }}" class="search-form">
                <input id="search" value="{{ request()->search }}" class="search-input" type="search" name="search" placeholder="Rechercher un article ou un terme">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="search-icon">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
            {{-- Navigation --}}

            <nav class="nav">
                @auth
                    <span class="user-name">{{ Auth::user()->name }}</span>
                @endauth
                <button
                    class="nav-button {{ auth()->guest() ? 'nav-button-guest' : '' }}"
                >
                    @auth
                    <img class="profile-image" src="{{ Gravatar::get(Auth::user()->email) }}" alt="Image de profil">

                    @else
                        
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="nav-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>
                    @endauth

                </button>
                <ul
                    class="nav-menu {{ auth()->guest() ? 'nav-menu-guest' : '' }}" tabindex="-1"
                >
                    @auth
                    
                    <li><a href="{{ route('home') }}" class="nav-link">Mon compte</a></li>
                    @if(Auth::user()->isEditeur())
                    <li><a href="{{ route('admin.articles.index') }}" class="nav-link">Gestion des articles</a></li>
                    @endif
                    <li><a href="{{ route('deconnexion') }}" class="nav-link" data-logout>Déconnexion</a></li>
                    <form action="{{ route('deconnexion') }}" method="post" class="form-logout">
                    @csrf
                    </form>

                    @else

                    <li><a href="{{ route('connexion') }}" class="nav-link">Connexion</a></li>
                    <li><a href="{{ route('inscription') }}" class="nav-link-inscription">Inscription</a></li>
                    
                    @endauth

                </ul>

                  @guest
                      
                <ul class="nav-menu-desktop">
                    <li><a href="{{ route('connexion') }}" class="nav-link-connexion">Connexion</a></li>
                    <li>
                        <a href="{{ route('inscription') }}" class="nav-link-desktop">
                            Inscription
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="nav-link-icon">
                                <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </ul>

                  @endguest  

            </nav>
        </header>

        @if(session('status'))
        <div class="success-alert">
           <div class="alert-container">
              <div class="icon-container">
                 <svg class="success-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                   <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                 </svg>
              </div>
                <div class="message-container">
                 <p class="alert-text">{{ session('status') }}</p>
                </div>
            </div>
        </div>
        @endif

        <main class="main-content">
            {{ $slot }}
        </main>
    </div>
</body>
</html>