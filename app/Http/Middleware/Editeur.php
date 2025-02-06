<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Providers\RouteServiceProvider;

class Editeur
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isEditeur()) {
            return $next($request);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
