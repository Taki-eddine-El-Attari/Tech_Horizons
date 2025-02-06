<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    // Constructeur du composant Select
    public function __construct(
        public string $name,
        public string $label,
        public $list = [],
        public $value = null,
        public ?string $id = null,
        public string $help = '',
        public bool $multiple = false,
        public string $optionsCles = 'id',
        public string $optionsText = 'name'
    ) {
        // Si $id n'est pas défini, on l'assigne à $name
        $this->id ??= $this->name;
    }

    // Rendu de la vue du composant
    public function render()
    {
        return view('components.select', [
            // Vérification de la collection
            'valueIsCollection' => is_object($this->value) && method_exists($this->value, 'contains')
        ]);
    }
}
