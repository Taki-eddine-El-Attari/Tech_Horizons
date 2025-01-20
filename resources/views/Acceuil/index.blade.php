<x-default-layout>
    <div class="posts">
        @forelse ($articles as $article)
       <x-article :$article list />
        @empty
            <p class="aucun-resultat">Aucun résultat.</p>
        @endforelse
    </div>
        {{-- Pagination --}}
    <div class="pagination-container">
        @if($articles->count() > 0)
            <div class="pagination-info">
            Affichage de {{ $articles->firstItem() }} à {{ $articles->lastItem() }} sur {{ $articles->total() }} résultats
            </div>
        @endif
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
</x-default-layout>