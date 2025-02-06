<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Carbon\Carbon;

class DateTime extends Component
{
    public $date;
    
    // Parse la date avec Carbon
    public function __construct($date)
    {
        // Convertit la date en objet Carbon pour faciliter les opérations sur la date
        $this->date = Carbon::parse($date); 
    }

    // Retourne la vue du composant
    public function render()
    {
        return view('components.date-time');
    }
}
