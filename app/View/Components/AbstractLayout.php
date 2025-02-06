<?php

namespace App\View\Components;

use Illuminate\View\Component;

abstract class AbstractLayout extends Component
{
    // Titre de la page
    public function __construct(public string $titre = '')
    {
        $this->titre = config('app.name') . ($titre ? ' | ' . $titre : '');
    }

}
