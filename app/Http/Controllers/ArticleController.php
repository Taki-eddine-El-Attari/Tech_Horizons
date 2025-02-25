<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Historique;
use App\Models\Commentaire;
use App\Models\Statut;
use App\Models\Theme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends BaseController
{
    // Initialise le contrôleur
    public function __construct()
    {
        $this->middleware('auth')->only(['commentaire']);
    }

    // Affiche la liste des articles
    public function index(Request $request): View
    {
        return $this->articleView($request->search ? ['search' => $request->search] : []);
    }

    // Affiche les articles d'un thème spécifique
    public function articlebytheme(Theme $theme): View
    {
        return $this->articleView(['theme' => $theme]);
    }

    // Affiche les articles d'un numéro spécifique
    public function articlebynumero($numero, Theme $theme): View
    {
        return view('Acceuil.index', [
            'articles' => Article::where('numero_id', $numero)->latest()->paginate(10),
        ]);
    }

    // Affiche les articles d'un statut spécifique
    public function articlebystatut(Statut $statut): View
    {
        return view('Acceuil.index', [
            'articles' => Article::where('statut_id', $statut->id)->latest()->paginate(10),
        ]);
    }

    // Affiche la liste des articles en fonction des filtres
    protected function articleView(array $filters): View
    {
        $query = Article::filters($filters);

        //Gestion des abonnements
        if (Auth::check()) {
            $user = Auth::user();

            // Si l'utilisateur est abonné
            if ($user->isAbonne()) {
                // Récupérer les theme_ids de l'utilisateur depuis la table abonnements
                $userThemeIds = $user->themes()->pluck('themes.id')->toArray();

                if (!empty($userThemeIds)) {
                    // Afficher uniquement les articles des thèmes auxquels l'utilisateur est abonné
                    $query->whereIn('theme_id', $userThemeIds);
                }

                // Et uniquement les articles publiés
                $query->where('statut_id', 3);
            }
        }

        return view('Acceuil.index', [
            'articles' => $query->latest()->paginate(10),
        ]);
    }

    // Affiche un article spécifique
    public function show(Article $article): View
    {
        // Si l'utilisateur est connecté, on enregistre l'historique de navigation
        if (Auth::check()) {
            Historique::create([
                'user_id' => Auth::id(),
                'article_id' => $article->id,
                'viewed_at' => now()
            ]);
        }

        return view('Acceuil.show', [
            'article' => $article,
        ]);
    }

    // Enregistre un commentaire pour un article
    public function commentaire(Article $article, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'commentaire' => ['required', 'string', 'min:2', 'max:255'],
            'rating' => ['nullable', 'integer', 'min:0', 'max:5'], // le rating optionnel
        ]);

        $commentaire = new Commentaire();
        $commentaire->contenu = $validated['commentaire'];
        $commentaire->note = $validated['rating'] ?? 0;
        $commentaire->article_id = $article->id;
        $commentaire->user_id = Auth::id();
        $commentaire->save();

        return back()->with('status', 'Commentaire publié !');
    }

    // Calcule la note moyenne d'un article
    public function calculateAverageRating(Article $article)
    {
        $comments = Commentaire::where('article_id', $article->id);
        $sumRatings = $comments->sum('note');
        $totalComments = $comments->count();

        if ($totalComments > 0) {
            $average = $sumRatings / $totalComments;
            return round($average, 1); // Arrondi à 1 décimale
        }

        return 0; // Retourne 0 s'il n'y a pas de commentaires
    }

    // Supprime un commentaire
    public function destroyComment(Commentaire $commentaire): RedirectResponse
    {
        $user = Auth::user();

        // Vérifie si l'utilisateur est éditeur OU responsable du thème de l'article
        if (!($user->isEditeur() ||
            ($user->isResponsable() && $user->theme_id === $commentaire->article->theme_id))) {
            abort(403, 'Non autorisé à supprimer ce commentaire');
        }

        $commentaire->delete();
        return back()->with('status', 'Commentaire supprimé avec succès !');
    }
}
