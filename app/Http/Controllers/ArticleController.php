<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Commentaire;
use App\Models\Numero;
use App\Models\Statut;
use App\Models\Theme;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;
class ArticleController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth')->only('commentaire');
    }
    public function index(Request $request) :View
    {
        return $this->articleView($request->search ? ['search' => $request->search] : []);
    }
    public function articlebytheme(Theme $theme): View
    {
       return $this->articleView(['theme' => $theme]);

    }
    public function articlebynumeroandtheme($numero, Theme $theme): View
    {
        return view('Acceuil.index',[
            'articles' => Article::where('theme_id', $theme->id)
                                 ->where('numero_id', $numero)
                                 ->latest()
                                 ->paginate(10),
        ]);
    }
    public function articlebystatut(Statut $statut): View
    {
        return view('Acceuil.index',[
           // 'articles' => $statut->articles()->latest()->paginate(10),

            'articles' => Article::where(
                'statut_id', $statut->id
            )->latest()->paginate(10),
        ]);
        

    }
protected function articleView(array $filters): View
{
    return view('Acceuil.index',[
        'articles' => Article::filters($filters)->latest()->paginate(10),
    ]);

}

    public function show(Article $article) :View
    {
        return view('Acceuil.show',[
            'article' => $article,
        ]);
    }

    public function commentaire(Article $article, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'commentaire' => ['required', 'string', 'min:2', 'max:255'],
        ]);

        $commentaire = new Commentaire();
        $commentaire->contenu = $validated['commentaire'];
        $commentaire->article_id = $article->id;
        $commentaire->user_id = Auth::id();
        $commentaire->save();

        return back()->with('status', 'Commentaire publié !');
    }

    
}
