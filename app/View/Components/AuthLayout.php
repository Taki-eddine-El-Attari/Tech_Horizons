<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;

class AuthLayout extends AbstractLayout
{
    // Constructeur du layout d'authentification
    public function __construct(
        public string $titre = '',
        public string $action = '',
        public string $submitMessage = "Soumettre",
        public string $titreAuth = '',
    )
    {
        parent::__construct($titre);    
    }

    // Retourne la vue du composant
    public function render(): View|Closure|string
    {
        return view('layouts.auth');
    }
}
