<?php

// Importation des contrôleurs
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

// Routes d'authentification
Route::get('/inscription', [InscriptionController::class, 'showRegistrationForm'])->name('inscription'); // Affichage du formulaire d'inscription
Route::post('/inscription', [InscriptionController::class, 'inscription']); // Traitement de l'inscription
Route::get('/connexion', [ConnexionController::class, 'showConnexionForm'])->name('connexion'); // Affichage du formulaire de connexion
Route::post('/connexion', [ConnexionController::class, 'connexion']); // Traitement de la connexion
Route::post('/deconnection', [ConnexionController::class, 'deconnexion'])->name('deconnexion'); // Déconnexion de l'utilisateur

// Routes pour l'historique utilisateur
Route::get('/historiques', [HomeController::class, 'history'])->name('history')->middleware('auth'); // Affichage de l'historique de l'utilisateur
Route::delete('/historiques/{history}', [HomeController::class, 'destroyHistory'])->name('history.destroy'); // Suppression d'un élément de l'historique

// Routes de gestion du profil utilisateur
Route::get('/home' , [HomeController::class, 'index'])->name('home'); // Affichage de la page d'accueil de l'utilisateur
Route::patch('/home' , [HomeController::class, 'updatePassword']); // Mise à jour du mot de passe de l'utilisateur
Route::patch('/profile', [HomeController::class, 'updateProfile'])->name('profile.update'); // Mise à jour du profil de l'utilisateur
Route::patch('/password', [HomeController::class, 'updatePassword'])->name('password.update'); // Mise à jour du mot de passe de l'utilisateur
Route::patch('/theme', [HomeController::class, 'updatetheme'])->name('theme.update'); // Mise à jour du thème de l'utilisateur

// Routes d'administration (articles et utilisateurs)
Route::resource('/admin/articles', CrudArticleController::class)->except('show')->names('admin.articles'); // Gestion des articles en mode administration
Route::resource('/admin/Utilisateurs', CrudUserController::class)->except('show')->names('admin.utilisateurs'); // Gestion des utilisateurs en mode administration

// Route des statistiques admin
Route::get('/admin/statistiques', [StatistiqueController::class, 'index'])->name('admin.statistiques.index'); // Affichage des statistiques en mode administration

// Route racine avec redirection conditionnelle
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('index'); // Redirection vers la page d'accueil si l'utilisateur est connecté
    }
    return app(InviteController::class)->indexInvite(); // Affichage de la page d'accueil pour les invités
})->name('indexinvite');

// Routes de navigation principale
Route::get('/Page_Principale', [ArticleController::class, 'index'])->name('index'); // Affichage de la page principale
Route::get('/themes/{theme:slug}', [ArticleController::class, 'articlebytheme'])->name('articles.bytheme'); // Affichage des articles par thème
Route::get('/Statuts/{statut}', [ArticleController::class, 'articlebystatut'])->name('articles.bystatut'); // Affichage des articles par statut
Route::get('/{article}', [ArticleController::class, 'show'])->name('articles.show'); // Affichage d'un article
Route::get('/Numeros/{numero}', [ArticleController::class, 'articlebynumero'])->name('articles.bynumero'); // Affichage des articles par numéro

// Gestion des commentaires
Route::post('/articles/{article}/commentaire', [ArticleController::class, 'commentaire'])->name('articles.commentaire'); // Ajout d'un commentaire à un article
Route::delete('/commentaires/{commentaire}', [ArticleController::class, 'destroyComment'])->name('commentaires.destroy'); // Suppression d'un commentaire
