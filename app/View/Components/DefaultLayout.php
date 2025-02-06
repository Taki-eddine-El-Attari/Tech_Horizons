<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;

class DefaultLayout extends AbstractLayout
{
    // Retourne la vue du layout par default
    public function render(): View|Closure|string
    {
        return view('Layouts.default');
    }
    
}
