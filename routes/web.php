<?php

use App\Http\Controllers\CrudArticleController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\ConnexionController;
use App\Http\Controllers\Auth\InscriptionController;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\StatistiqueController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/inscription', [InscriptionController::class, 'showRegistrationForm'])->name('inscription');
Route::post('/inscription', [InscriptionController::class, 'inscription']);
Route::get('/connexion', [ConnexionController::class, 'showConnexionForm'])->name('connexion');
Route::post('/connexion', [ConnexionController::class, 'connexion']);
Route::post('/deconnection', [ConnexionController::class, 'deconnexion'])->name('deconnexion');

Route::get('/historiques', [HomeController::class, 'history'])->name('history')->middleware('auth');
Route::delete('/historiques/{history}', [HomeController::class, 'destroyHistory'])->name('history.destroy');

Route::get('/home' , [HomeController::class, 'index'])->name('home');
Route::patch('/home' , [HomeController::class, 'updatePassword']);
Route::patch('/profile', [HomeController::class, 'updateProfile'])->name('profile.update');
Route::patch('/password', [HomeController::class, 'updatePassword'])->name('password.update');
Route::patch('/theme', [HomeController::class, 'updatetheme'])->name('theme.update');


Route::resource('/admin/articles', CrudArticleController::class)->except('show')->names('admin.articles');
Route::resource('/admin/Utilisateurs', CrudUserController::class)->except('show')->names('admin.utilisateurs');


Route::get('/admin/statistiques', [StatistiqueController::class, 'index'])->name('admin.statistiques.index');

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('index');
    }
    return app(InviteController::class)->indexInvite();
})->name('indexinvite');


Route::get('/Page_Principale', [ArticleController::class, 'index'])->name('index');
Route::get('/themes/{theme:slug}', [ArticleController::class, 'articlebytheme'])->name('articles.bytheme');
Route::get('/Statuts/{statut}', [ArticleController::class, 'articlebystatut'])->name('articles.bystatut');
Route::get('/{article}', [ArticleController::class, 'show'])->name('articles.show'); 
Route::get('/Numeros/{numero}', [ArticleController::class, 'articlebynumero'])->name('articles.bynumero');


Route::post('/articles/{article}/commentaire', [ArticleController::class, 'commentaire'])->name('articles.commentaire');

Route::delete('/commentaires/{commentaire}', [ArticleController::class, 'destroyComment'])->name('commentaires.destroy');

