<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
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
        $this->id ??= $this->name;
    }

    public function render()
    {
        return view('components.select', [
            'valueIsCollection' => is_object($this->value) && method_exists($this->value, 'contains')
        ]);
    }
}
