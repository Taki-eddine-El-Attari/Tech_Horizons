<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    // ...existing code...

    public function boot()
    {
        // ...existing code...

        $this->registerMiddleware();
    }

    protected function registerMiddleware()
    {
        Route::aliasMiddleware('editeur', \App\Http\Middleware\Editeur::class);
    }

    // ...existing code...
}
