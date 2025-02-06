<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;

class InscriptionController extends BaseController
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Affiche le formulaire d'inscription
    public function showRegistrationForm(): View
    {
        return view('auth.inscription');
    }

    // Traite la soumission du formulaire d'inscription
    public function inscription(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required','string','between:5,255'],
            'email' => ['required','email','unique:users'],
            'password' => ['required','string','min:8','confirmed'],


        ]);

        $validated['password'] = Hash::make($validated['password']);


        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('home')->withStatus('Inscription réussie !');

    }
}
