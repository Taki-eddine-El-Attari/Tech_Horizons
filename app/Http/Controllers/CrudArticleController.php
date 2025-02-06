<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Theme;
use App\Models\Numero;
use App\Models\Statut;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CrudArticleController extends BaseController
{
    public function __construct()
    {
        
        $this->middleware('auth');
    }
    
    //Affiche l'interface de gestion des article
    public function index()
    {
        $user = Auth::user();
        $query = Article::with(['theme', 'numero', 'statut']);

        // Si l'utilisateur est responsable, on affiche uniquement les articles de son thème
        if ($user->isResponsable()) { 
            $query->whereHas('theme', function($q) use ($user) { 
                $q->where('id', $user->theme_id);
            });
        }

        $articles = $query->orderBy('created_at', 'desc')->get();

        return view('admin.articles.index', [
            'articles' => $articles
        ]);
    }
   
    //Affiche le formulaire de création d'article
    public function create(): View
    {
        return $this->showForm();
    }

    // Affiche le formulaire de modification
    public function edit(Article $article)
    {
        return $this->showForm($article);
    }

    // Affiche le formulaire
    protected function showForm(Article $article = new Article): View
    {
        return view('admin.articles.form', [
            'article' => $article,
            'themes' => Theme::orderBy('name')->get(),
            'numeros' => Numero::orderBy('numero')->get(),
            'statuts' => Statut::orderBy('name')->get(),
        ]);
    }

    // Ajout d'un nouvel article
    public function store(ArticleRequest $request): RedirectResponse
    {
        return $this->save($request->validated());
    }

    // Modification d'un article
    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        return $this->save($request->validated(), $article);
    }

    // Enregistre un nouvel article
    protected function save(array $data, Article $article = null): RedirectResponse
    {
        $user = Auth::user();

        if (isset($data['image'])) {
            if (isset($article->image)) {
                Storage::delete($article->image);
            }
            $data['image'] = $data['image']->store('Images Articles');
        }

        $data['extrait'] = Str::limit($data['contenu'], 150); // extrait par défaut
        $data['couleur'] = '#4f46e5'; // couleur par défaut
        $data['notes'] = 0; // notes par défaut

        if (isset($data['statut_id'])) {
            $data['statut_id'] = $data['statut_id'];
        }

        if (($user->isResponsable() || $user->isEditeur()) && !isset($data['statut_id'])) {
            $data['statut_id'] = 3; // publie par défaut
        }

        if ($user->isAbonne()  && !isset($data['statut_id'])) {
            $data['statut_id'] = 2; // en cours par défaut
        }

        // Si vous avez un numéro_id, l'ajouter directement
        if (isset($data['numero_id'])) {
            $data['numero_id'] = $data['numero_id'];
        }

        $article = Article::updateOrCreate(['id' => $article?->id], $data);

        return redirect()
            ->route('articles.show', ['article' => $article])
            ->withStatus($article->wasRecentlyCreated ? ($user->isAbonne() ? 'Article en cours de traitement par les responsables' : 'Article publié avec succès') : 'Article mis à jour avec succès');
    }

    // Supprime l'article
    public function destroy(Article $article): RedirectResponse
    {
        Storage::delete($article->image);
        $article->delete();

        return redirect()
            ->route('admin.articles.index')
            ->withStatus('Article supprimé avec succès');
    }
}
