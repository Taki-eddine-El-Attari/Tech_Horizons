<?php

namespace App\Http\Controllers;

use App\Enumérations\Role;
use App\Http\Requests\UserRequest;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;



class CrudUserController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', function ($request, $next) {
            if (Auth::user()->isResponsable() || Auth::user()->isEditeur()) {
                return $next($request);
            }
            return redirect()->route('home');
        }]);
    }

    // Affiche la liste des utilisateurs
    public function index(): View
    {
        $query = User::without('password')->orderBy('created_at', 'desc');
        
        // Si l'utilisateur connecté est un responsable, on ne montre que les abonnés
        if (Auth::user()->isResponsable()) {
            $query->where('role', Role::Abonne->value);
        }

        return view('admin.utilisateurs.index', [
            'users' => $query->get()
        ]);
    }
        
    //Affiche le formulaire de création d'article
    public function create()
    {
        return $this->showForm();
    }

    // Affiche le formulaire de modification
    public function edit($id) 
    {
        $user = User::findOrFail($id); // Recherche de l'utilisateur par ID
        return $this->showForm($user);
    }

    // Affiche le formulaire
    public function showForm(?User $user = null): View
    {
        $user = $user ?? new User();
        return view('admin.utilisateurs.form', [
            'user' => $user,
            'themes' => Theme::orderBy('name')->get(),

        ]);
    }
        
    // Ajout d'un nouvel utilisateur
    public function store(UserRequest $request): RedirectResponse
    {
        return $this->save($request->validated());
    }
        
    // Modification d'un utilisateur
    public function update(UserRequest $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        return $this->save($request->validated(), $user);
    }

    // Enregistre un nouvel utilisateur
    public function save(array $data, User $user = null): RedirectResponse
    {
        // Gestion du theme_id
        if (isset($data['theme_id']) && !empty($data['theme_id'])) {
            // Si un thème est sélectionné, on le garde
            $data['theme_id'] = $data['theme_id'];
        }else {
            // Pour les autres rôles sans thème sélectionné
            $data['theme_id'] = null;
        }

        if ($user) {
            // Modification
            if (empty($data['password'])) {
                unset($data['password']);
            }
            if (empty($data['email'])) {
                unset($data['email']);
            }
            $user->update($data);
        } else {
            // Création
            $user = User::create($data);
        }

        return redirect()
            ->route('admin.utilisateurs.index')
            ->withStatus($user->wasRecentlyCreated ? 'Utilisateur ajouté avec succès' : 'Utilisateur mis à jour avec succès');
    }

    // Supprime un utilisateur
    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()
            ->route('admin.utilisateurs.index')
            ->withStatus('Utilisateur supprimé avec succès');
    }
}
