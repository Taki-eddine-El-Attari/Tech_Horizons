<x-default-layout titre="Gestion des utilisateurs">
    <div class="admin-header">
        <div class="admin-header-title">
            <h1>Utilisateurs</h1>
            <p>Interface d'administration des utilisateurs.</p>
        </div>
        <div class="admin-header-actions">
            <a href="{{ route('admin.utilisateurs.create') }}" class="btn-primary">Créer un utilisateur</a>
        </div>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nom et prénom</th>
                    <th>Role</th>
                    <th>Email</th> 
                    <th></th>                   
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-right">
                        <a href="{{ route('admin.utilisateurs.edit', $user) }}" class="link-primary">
                            Modifier
                        </a>
                    </td>
                    <td class="text-right">
                        <a href="#" 
                           class="link-primary delete-post" 
                           data-form="delete-form-{{ $user->id }}">
                            Supprimer
                        </a>
                        <form id="delete-form-{{ $user->id }}" 
                              action="{{ route('admin.utilisateurs.destroy', ['Utilisateur' => $user->id]) }}" 
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
            <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
        </div>
        <div class="modal-footer">
            <button class="modal-button modal-cancel" id="cancelDelete">Annuler</button>
            <button class="modal-button modal-confirm" id="confirmDelete">Supprimer</button>
        </div>
    </div>
</x-default-layout>