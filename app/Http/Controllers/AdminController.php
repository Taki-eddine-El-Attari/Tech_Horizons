<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Theme;
use App\Models\Numero;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminController extends BaseController
{

    public function __construct()
    {
        $this->middleware('editeur'); 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.articles.index' , 
        [
            'articles' => Article::without('theme', 'numero', 'statut')->orderBy('created_at', 'desc')->get(),
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return $this->showForm();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return $this->showForm($article);
    }

    protected function showForm(Article $article = new Article) : View
    {
        return view('admin.articles.form', [
            'article' => $article,
            'themes' => Theme::orderBy('name')->get(),
            'numeros' => Numero::orderBy('numero')->get()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request): RedirectResponse
    {
        return $this->save($request->validated());
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        return $this->save($request->validated(), $article);
    }

    protected function save(array $data, Article $article = null) : RedirectResponse
    {
       if(isset($data['image'])){
         if(isset($article->image)){
            Storage::delete($article->image);
         }
         $data['image'] = $data['image']->store('Images Articles');
        } 

        $data['extrait'] = Str::limit($data['contenu'], 150);
        $data['couleur'] = '#4f46e5'; // couleur par défaut
        $data['notes'] = 0;
        $data['statut_id'] = 3;  // Pour etre publié
         
        // Si vous avez un numéro_id, l'ajouter directement
        if (isset($data['numero_id'])) {
            $data['numero_id'] = $data['numero_id'];
        }

        $article = Article::updateOrCreate(['id' => $article?->id] , $data);

        return redirect()
            ->route('articles.show', ['article' => $article])
            ->withStatus($article->wasRecentlyCreated ? 'Article publié avec succès' : 'Article mis à jour avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Storage::delete($article->image);
        $article->delete();

        return redirect()->route('admin.articles.index');
    }
}
