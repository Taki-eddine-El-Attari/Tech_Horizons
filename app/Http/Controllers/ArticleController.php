<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        
        return view('Acceuil.index',[
            'articles' => Article::latest()->paginate(10), //all pour recuperer tout sans ordre 

        ]);
    }
}
