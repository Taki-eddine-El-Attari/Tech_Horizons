<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\RedirectResponse;

class CommentaireController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'editeur']);
    }

    public function destroy(Commentaire $commentaire): RedirectResponse
    {
        $commentaire->delete();
        return back()->with('status', 'Commentaire supprimé !');
    }
}
