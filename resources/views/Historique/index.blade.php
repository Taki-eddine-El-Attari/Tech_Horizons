<x-default-layout :titre="'Historique'">
    <div class="historiques">
        <div class="historiques-header">
            <h1 class="historiques-title">Historique de navigation</h1>
            <p class="historiques-description">Consultez vos articles récemment visités</p>
        </div>

        <div class="historiques-section">
            <div class="historiques-filter">
                <form action="{{ route('history') }}" method="GET" class="filter-form">
                    <input type="text" name="search" placeholder="Rechercher un article" value="{{ request('search') }}" class="filter-input">
                    <select name="theme" class="filter-select">
                        <option value="">Tous les thèmes</option>
                        @foreach($themes as $theme)
                            <option value="{{ $theme->id }}" {{ request('theme') == $theme->id ? 'selected' : '' }}>
                                {{ $theme->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="date" name="date" value="{{ request('date') }}" class="filter-date">
                    <button type="submit" class="filter-button">Filtrer</button>
                </form>
            </div>

            <div class="historiques-list">
                @forelse($histories as $history)
                    <div class="history-item">
                        <div class="history-content">
                            <div class="history-header">
                                <h3 class="history-title">
                                    <a href="{{ route('articles.show', $history->article) }}">
                                        {{ $history->article->titre }}
                                    </a>
                                </h3>
                                <form action="{{ route('history.destroy', $history) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button" data-confirm="Êtes-vous sûr de vouloir supprimer cet historique ?">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="delete-icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <p class="history-meta">
                                <span class="history-theme">{{ $history->article->theme->name }}</span>
                                <x-date-time :date="$history->viewed_at" />
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="history-empty">Aucun historique trouvé</p>
                @endforelse
            </div>

            <div class="historiques-pagination">
                {{ $histories->links() }}
            </div>
        </div>
    </div>

    <!-- Modal de confirmation -->
    <div class="modal-backdrop" id="deleteModal-backdrop"></div>
    <div class="modal" id="deleteModal">
        <div class="modal-header">
            <h3 class="modal-title">Confirmer la suppression</h3>
        </div>
        <div class="modal-body">
            <p>Êtes-vous sûr de vouloir supprimer cet historique ?</p>
        </div>
        <div class="modal-footer">
            <button class="modal-button modal-cancel" id="cancelDelete">Annuler</button>
            <button class="modal-button modal-confirm" id="confirmDelete">Supprimer</button>
        </div>
    </div>
</x-default-layout>

