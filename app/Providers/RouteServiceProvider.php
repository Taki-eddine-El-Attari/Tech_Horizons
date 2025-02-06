<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    // Définit la route de redirection après authentification
    public const HOME = '/home';

    // Active les middlewares personnalisés dans les routes
    public function boot()
    {
        $this->registerMiddleware();
    }

    // Enregistre les middlewares personnalisés pour l'utilisation dans les routes
    protected function registerMiddleware()
    {
        Route::aliasMiddleware('editeur', \App\Http\Middleware\Editeur::class);
        Route::aliasMiddleware('responsable', \App\Http\Middleware\Responsable::class);
    }

}
