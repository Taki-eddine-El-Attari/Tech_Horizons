<x-default-layout titre="Gestion des articles">
    <div class="admin-header">
        <div class="admin-header-title">
            <h1>Posts</h1>
            @if (!auth()->user()->isAbonne())
            <p>Interface d'administration des articles.</p>
            @else
            <p>Vous pouvez proposer de nouveaux articles.</p>
            @endif
        </div>
        <div class="admin-header-actions">
            <a href="{{ route('admin.articles.create') }}" class="btn-primary">Créer un post</a>
        </div>
    </div>
    @if (!auth()->user()->isAbonne())
        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Statut</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td class="text-width">{{ $article->titre }}</td>
                        <td>{{ $article->statut->name }}</td>
                        <td class="text-right">
                            <a href="{{ route('articles.show', ['article' => $article]) }}" target="_blank" class="link-primary">
                                Voir l'article
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('admin.articles.edit', ['article' => $article]) }}" class="link-primary">
                                Modifier
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="#" 
                               class="link-primary delete-post" 
                               data-form="delete-form-{{ $article->id }}">
                                Supprimer
                            </a>
                            <form id="delete-form-{{ $article->id }}" 
                                  action="{{ route('admin.articles.destroy', ['article' => $article]) }}" 
                                  method="POST" 
                                  class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal de confirmation -->
        <div class="modal-backdrop" id="deleteModal-backdrop"></div>
        <div class="modal" id="deleteModal">
            <div class="modal-header">
                <h3 class="modal-title">Confirmer la suppression</h3>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>
            </div>
            <div class="modal-footer">
                <button class="modal-button modal-cancel" id="cancelDelete">Annuler</button>
                <button class="modal-button modal-confirm" id="confirmDelete">Supprimer</button>
            </div>
        </div>
    @endif
</x-default-layout>