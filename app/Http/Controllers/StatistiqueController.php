<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Commentaire;
use App\Models\Theme;
use App\Models\Numero;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class StatistiqueController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth', function ($request, $next) {
            if (Auth::user()->isResponsable() || Auth::user()->isEditeur()) {
                return $next($request);
            }
            return redirect()->route('home');
        }]);
    }

    public function index()
    {
        $articles = Article::all();
        $users = User::all();
        $commentaires = Commentaire::all();
        $themes = Theme::all();
        $numeros = Numero::all();

        return view('admin.statistiques.index', compact('articles', 'users', 'commentaires', 'themes', 'numeros'));
    }
}
