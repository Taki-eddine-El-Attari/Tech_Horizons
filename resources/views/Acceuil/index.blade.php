<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title> {{-- Récupère le nom de l'application dans le fichier .env --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="body-styles">
    {{-- Conteneur global --}}
    <div class="container">
        {{-- Header --}}
        <header class="header">
            {{-- Logo --}}
            <a href="{{ route('index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="logo">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                </svg>
            </a>
            {{-- Formulaire de recherche --}}
            <form action="{{ route('index') }}" class="search-form">
                <input id="search" value="" class="search-input" type="search" name="search" placeholder="Rechercher un article">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="search-icon">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
            {{-- Navigation --}}
            <nav class="nav">
                <button
                    class="nav-button"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="nav-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>
                </button>
                <ul
                    class="nav-menu"
                    tabindex="-1"
                >
                    <li><a href="" class="nav-link">Connexion</a></li>
                    <li>
                        <a href="" class="nav-link-inscription">
                            Inscription
                        </a>
                    </li>
                </ul>
                <ul class="nav-menu-desktop">
                    <li><a href="" class="nav-link-connexion">Connexion</a></li>
                    <li>
                        <a href="" class="nav-link-desktop">
                            Inscription
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="nav-link-icon">
                                <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </header>

        <main class="main-content">
            <div class="posts">
                @foreach ($articles as $article)
                {{-- Début du post --}}
                <article class="post">
                    <div class="post-image-container">
                        <img class="post-image" src="{{ $article->image }} ">
                    </div>
                    <div class="post-content">
                        <a href="" class="post-category">Thème</a>
                        <h1 class="post-title">{{ $article->titre }}</h1>
                        <ul class="post-tags">
                            <li><a href="" class="post-tag">N°1</a></li>
                        </ul>
                        <p class="post-description">{{ $article->extrait }}</p>
                        <a href="" class="post-read-more">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="post-read-more-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                            </svg>
                            Lire l'article
                        </a>
                    </div>
                </article>
                {{-- Fin du post --}}
                @endforeach
            </div>
            {{-- Pagination --}}
            <div class="pagination-container">
                <div class="pagination-info">
                    Affichage de {{ $articles->firstItem() }} à {{ $articles->lastItem() }} sur {{ $articles->total() }} résultats
                </div>
                <div class="pagination">
                    @if($articles->hasPages())
                        <nav>
                            <ul class="pagination-list">
                                {{-- Bouton précédent --}}
                                @if($articles->onFirstPage())
                                    <li class="pagination-item disabled">
                                        <span>&larr;</span>
                                    </li>
                                @else
                                    <li class="pagination-item">
                                        <a href="{{ $articles->previousPageUrl() }}">&larr;</a>
                                    </li>
                                @endif

                                {{-- Numéros des pages --}}
                                @foreach(range(1, $articles->lastPage()) as $page)
                                    <li class="pagination-item {{ $articles->currentPage() === $page ? 'active' : '' }}">
                                        <a href="{{ $articles->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                {{-- Bouton suivant --}}
                                @if($articles->hasMorePages())
                                    <li class="pagination-item">
                                        <a href="{{ $articles->nextPageUrl() }}">&rarr;</a>
                                    </li>
                                @else
                                    <li class="pagination-item disabled">
                                        <span>&rarr;</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>