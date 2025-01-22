<x-default-layout :titre="$article->exists ? 'Modifier l\'article' : 'Créer un article'">
    <form action="{{ $article->exists ? route('admin.articles.update' , ['article' => $article]) : route('admin.articles.store') }}" method="POST" class="password-form" enctype="multipart/form-data">
        @csrf
        @if($article->exists)
            @method('PUT')
        @endif
        <div class="form-section">
            <h1 class="form-title">{{ $article->exists ? 'Modifier l\'article': 'Création d\'un article' }}</h1>
            <p class="form-description">{{ $article->exists ? 'Modifiez votre article pour le rendre encore meilleur !' : 'Partagez votre savoir, inspirez le monde !'}}</p>

            <div class="form-fields">
                <x-input label="Titre" name="titre" minlength="3" :value="old('titre', $article->titre )"></x-input>
                <x-input label="Slug" name="slug" minlength="3" :value="old('slug', $article->slug )" help="Le slug sera généré automatiquement. Personnalisez-le uniquement si nécessaire."></x-input>
                <x-select name="theme_id" label="Thème" :list="$themes" :value="old('theme_id', $article->theme_id )"></x-select>
                <x-select name="numero_id" label="Numéro" :list="$numeros" :value="old('numero_id', $article->numero_id )"></x-select>
                @if($article->exists)
                    <x-select name="statut_id" label="Statut" :list="$statuts" :value="old('statut_id', $article->statut_id)"></x-select>
                @endif
                <x-textarea label="Contenu" name="contenu" minlength="10" help="Le contenu de votre article.">{{ old('contenu', $article->contenu ) }}</x-textarea>
                <x-image label="Image de couverture" name="image" type="file" :value="old('image', $article->image )" help="Pour un meilleur rendu, utilisez une image carrée de 400x400px"></x-image>
            </div>

            <div class="form-actions">
                <button type="submit" class="form-submit-button">{{ $article->exists ? 'Modifier' : 'Publier' }}</button>
            </div>
        </div>
    </form>
</x-default-layout>