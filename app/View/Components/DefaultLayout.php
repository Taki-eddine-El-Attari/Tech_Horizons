<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DefaultLayout extends AbstractLayout
{
    
    public function render(): View|Closure|string
    {
        return view('Layouts.default');
    }
    
}
