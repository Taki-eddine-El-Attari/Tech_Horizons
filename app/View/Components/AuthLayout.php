<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthLayout extends AbstractLayout
{

    public function __construct(
        public string $titre = '',
        public string $action = '',
        public string $submitMessage = "Soumettre",
        public string $titreAuth = '',
    )
    
    {
        parent::__construct($titre);    
    }



    public function render(): View|Closure|string
    {
        return view('layouts.auth');
    }
}
