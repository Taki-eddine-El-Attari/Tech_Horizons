<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\BrowsingHistory;
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
    public function __construct()
    {
        $this->middleware('auth')->only(['commentaire']);
    }

    public function index(Request $request) :View
    {
        return $this->articleView($request->search ? ['search' => $request->search] : []);
    }

    public function articlebytheme(Theme $theme): View
    {
       return $this->articleView(['theme' => $theme]);

    }

    public function articlebynumero($numero, Theme $theme): View
    {
        return view('Acceuil.index',[
            'articles' => Article::where('numero_id', $numero)->latest()->paginate(10),
        ]);
    }

    public function articlebystatut(Statut $statut): View
    {
        return view('Acceuil.index',[
           // 'articles' => $statut->articles()->latest()->paginate(10),

            'articles' => Article::where('statut_id', $statut->id)->latest()->paginate(10),
        ]);
        

    }

    protected function articleView(array $filters): View
    {
        $query = Article::filters($filters);

        //Gestion des abonnements
        if (Auth::check()) {
            $user = Auth::user();
            
            // Si l'utilisateur est abonné
            if ($user->isAbonne()) {
                // Récupérer les theme_ids de l'utilisateur depuis la table pivot
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

    public function show(Article $article) :View
    {
        // Vérifier si l'utilisateur abonné peut voir cet article
        if (Auth::check() && Auth::user()->isAbonne() && $article->statut_id !== 3) {
            abort(403, 'Cet article n\'est pas encore publié');
        }

        // Si l'utilisateur est connecté, on enregistre l'historique de navigation
        if(Auth::check()) {
            BrowsingHistory::create([
                'user_id' => Auth::id(),
                'article_id' => $article->id,
                'viewed_at' => now()
            ]);
        }

        return view('Acceuil.show',[
            'article' => $article,
        ]);
    }

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
