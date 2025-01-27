<?php

namespace App\Http\Controllers;

use App\Enumérations\Role;
use App\Http\Requests\UserRequest;
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

    public function index()
    {
        return view(
            'admin.utilisateurs.index',
            [
                'users' => User::without('password')->orderBy('created_at', 'desc')->get(),
            ]
        );
    }

    public function create()
    {
        return $this->showForm();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return $this->showForm($user);
    }

    public function showForm(?User $user = null): View
    {
        $user = $user ?? new User();
        return view('admin.utilisateurs.form', ['user' => $user]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        return $this->save($request->validated());
    }

    public function update(UserRequest $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        return $this->save($request->validated(), $user);
    }

    public function save(array $data, User $user = null): RedirectResponse
    {
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


    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()
            ->route('admin.utilisateurs.index')
            ->withStatus('Utilisateur supprimé avec succès');
    }
}
