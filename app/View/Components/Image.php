<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

use Illuminate\View\Component;

class Image extends Component
{
    // Constructeur du composant Image
    public function __construct(
        public string $name,
        public string $label,
        public string $type = 'text', 
        public ?string $value = null,
        public ?string $id = null,
        public string $help = '',
    )
    {
        $this->id ??= $this->name; // Si $id n'est pas défini, on l'assigne à $name
    }

    // Vérifie si le fichier est une image
    public function isImage(): bool
    {
        // Récupérer le type MIME de l'image
        return str_starts_with(Storage::mimeType($this->value), 'image/'); 
    }

    // Rendu de la vue du composant
    public function render(): View|Closure|string
    {
        return view('components.image');
    }
}
