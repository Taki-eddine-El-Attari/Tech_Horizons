<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ConnexionController extends BaseController
{
    public function __construct()
    {
        $this->middleware('guest')->except('deconnexion');
        $this->middleware('auth')->only('deconnexion');

    }


    public function showConnexionForm(): View
    {
        return view('auth.connexion');
    }

    public function Connexion(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials,(bool) $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return back()->withErrors(
            ['email' => 'Les identifiants fournis ne correspondent à aucun compte.']
        )->onlyInput("email");


    }

    public function deconnexion(Request $request): RedirectResponse
    {
      Auth::logout();
 
      $request->session()->invalidate();
 
      $request->session()->regenerateToken();
 
      return redirect('/');
    }
}
