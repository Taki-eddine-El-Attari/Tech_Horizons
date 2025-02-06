<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Historique;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class HomeController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Affiche les themes dans la session des abonnements
    public function index(): View
    {
        $themes = Theme::all();
        return view('Home.index', compact('themes'));
    }

    // Met à jour les abonnements de l'utilisateur
    public function updatetheme(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $validated = $request->validate([
            'theme_id' => ['required', 'array'],
            'theme_id.*' => ['exists:themes,id']
        ]);

        $user->themes()->sync($validated['theme_id']);
        
        return redirect()->route('home')->withStatus('Thèmes mis à jour avec succès !');
    }

    // Met à jour le profil de l'utilisateur
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($validated);
        
        return redirect()->route('home')->withStatus('Informations mises à jour avec succès !');
    }

    // Met à jour le mot de passe de l'utilisateur
    public function updatePassword(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $validated = $request->validate([

            'current_password' => [
                'required', 
                'string', 
                function (string $attribute, mixed $value, Closure $fail) use($user) {
                if (! Hash::check($value, $user->password)) {
                    $fail("Le :attribute est invalide.");
                }
            },
        ],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]); 
        
        return redirect()->route('home')->withStatus('Mot de passe mis à jour avec succès !');
    }

    // Affiche l'historique des activités
    public function history(Request $request): View
    {
        $histories = Historique::where('user_id', Auth::id())
            ->with(['article.theme'])
            ->filter(request(['search', 'theme', 'date']))
            ->latest('viewed_at')
            ->paginate(10)
            ->withQueryString();

        $themes = Theme::all();

        return view('Historique.index', compact('histories', 'themes'));
    }

    // Supprime un élément de l'historique
    public function destroyHistory(Historique $history): RedirectResponse
    {
        if ($history->user_id !== Auth::id()) {
            abort(403);
        }
        
        $history->delete();
        return redirect()->route('history')->withStatus('Historique supprimé avec succès');
    }

}
