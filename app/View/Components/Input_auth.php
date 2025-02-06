<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input_auth extends Component
{
    // Constructeur du composant Input_auth
    public function __construct(
        public string $name,
        public string $label,
        public string $type = 'text', 
        public ?string $value = null,
        public ?string $id = null,
        public string $help = '',
    )
    {
        // Si $id n'est pas défini, on l'assigne à $name
        $this->id ??= $this->name;
    }

    // Rendu de la vue du composant
    public function render(): View|Closure|string
    {
        return view('components.input_auth');
    }
}
