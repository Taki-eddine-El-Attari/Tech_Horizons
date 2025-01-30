<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;

class DefaultLayout extends AbstractLayout
{
    
    public function render(): View|Closure|string
    {
        return view('Layouts.default');
    }
    
}
