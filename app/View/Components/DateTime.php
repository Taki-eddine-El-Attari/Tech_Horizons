<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Carbon\Carbon;

class DateTime extends Component
{
    public $date;

    public function __construct($date)
    {
        $this->date = Carbon::parse($date);
    }

    public function render()
    {
        return view('components.date-time');
    }
}
