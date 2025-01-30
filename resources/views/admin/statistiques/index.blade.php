<x-default-layout :titre="'Statistiques'">
    <div class="statistiques">
        <div class="statistiques-header">
            <h1 class="statistiques-title">Statistiques</h1>
            <p class="statistiques-description">Découvrez les statistiques de Tech Horizons</p>
        </div>
        <div class="statistiques-content">
            <div class="statistiques-section">
                <h2 class="statistiques-section-title">Articles</h2>
                <div class="statistiques-section-content">
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Nombre d'articles</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Articles publiés</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->where('statut_id', 3)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Articles en attente</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->where('statut_id', 2)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Articles refusés</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->where('statut_id', 1)->count() }}"></p>
                    </div>
                </div>
            </div>
            <div class="statistiques-section">
                <h2 class="statistiques-section-title">Themes</h2>
                <div class="statistiques-section-content">
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Nombre d'articles pour L'intelligence artificielle</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->where('theme_id', 1)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Nombre d'articles pour L'internet des objets</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->where('theme_id', 2)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Nombre d'articles pour Cybersécurité</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->where('theme_id', 3)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Nombre d'articles pour La réalité virtuelle</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->where('theme_id', 4)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Nombre d'articles pour Blockchain</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->where('theme_id', 5)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Nombre de themes</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $themes->count() }}"></p>
                    </div>
                </div>
            </div>
            <div class="statistiques-section">
                <h2 class="statistiques-section-title">Numéros</h2>
                <div class="statistiques-section-content">
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Articles de numéro 1</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->where('numero_id', 1)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Articles de numéro 2</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->where('numero_id', 2)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Articles de numéro 3</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->where('numero_id', 3)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Articles de numéro 4</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->where('numero_id', 4)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Articles de numéro 5</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $articles->where('numero_id', 5)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Nombre de numéros</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $numeros->count() }}"></p>
                    </div>
                </div>
            </div>
            <div class="statistiques-section">
                <h2 class="statistiques-section-title">Utilisateurs</h2>
                <div class="statistiques-section-content">
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Nombre d'utilisateurs</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $users->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Nombre d'éditeurs</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $users->where('role', 'Éditeur')->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Nombre de responsables</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $users->where('role', 'Responsable')->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Nombre d'abonné</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $users->where('role', 'Abonné')->count() }}"></p>
                    </div>
                </div>
            </div>

            <div class="statistiques-section">
                <h2 class="statistiques-section-title">Commentaires</h2>
                <div class="statistiques-section-content">
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Nombre total de commentaires</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $commentaires->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Commentaires notés 5 étoiles </h3>
                        <p class="statistiques-section-item-value" data-target="{{ $commentaires->where('note', 5)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Commentaires notés 4 étoiles </h3>
                        <p class="statistiques-section-item-value" data-target="{{ $commentaires->where('note', 4)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Commentaires notés 3 étoiles </h3>
                        <p class="statistiques-section-item-value" data-target="{{ $commentaires->where('note', 3)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Commentaires notés 2 étoiles </h3>
                        <p class="statistiques-section-item-value" data-target="{{ $commentaires->where('note', 2)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Commentaires notés 1 étoile </h3>
                        <p class="statistiques-section-item-value" data-target="{{ $commentaires->where('note', 1)->count() }}"></p>
                    </div>
                    <div class="statistiques-section-item">
                        <h3 class="statistiques-section-item-title">Commentaires sans étoiles</h3>
                        <p class="statistiques-section-item-value" data-target="{{ $commentaires->where('note', 0)->count() }}"></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-default-layout>
