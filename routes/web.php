<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\ConnexionController;
use App\Http\Controllers\Auth\InscriptionController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/inscription', [InscriptionController::class, 'showRegistrationForm'])->name('inscription');
Route::post('/inscription', [InscriptionController::class, 'inscription']);
Route::get('/connexion', [ConnexionController::class, 'showConnexionForm'])->name('connexion');
Route::post('/connexion', [ConnexionController::class, 'connexion']);
Route::post('/deconnection', [ConnexionController::class, 'deconnexion'])->name('deconnexion');


Route::get('/home' , [HomeController::class, 'index'])->name('home');
Route::patch('/home' , [HomeController::class, 'updatePassword']);
Route::patch('/profile', [HomeController::class, 'updateProfile'])->name('profile.update');
Route::patch('/password', [HomeController::class, 'updatePassword'])->name('password.update');


Route::resource('/admin/articles', AdminController::class)->except('show')->names('admin.articles');

Route::get('/', [ArticleController::class, 'index'])->name('index');
Route::get('/themes/{theme:slug}', [ArticleController::class, 'articlebytheme'])->name('articles.bytheme');
Route::get('/Statuts/{statut}', [ArticleController::class, 'articlebystatut'])->name('articles.bystatut');
Route::get('/{article}', [ArticleController::class, 'show'])->name('articles.show'); 
Route::get('/Numeros/{numero}/{theme:slug}', [ArticleController::class, 'articlebynumeroandtheme'])->name('articles.bynumeroandtheme');

Route::post('/articles/{article}/commentaire', [ArticleController::class, 'commentaire'])->name('articles.commentaire');

