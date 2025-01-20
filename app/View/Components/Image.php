<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

use Illuminate\View\Component;

class Image extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $label,
        public string $type = 'text', 
        public ?string $value = null,
        public ?string $id = null,
        public string $help = '',
    )
    {
        $this->id ??= $this->name;
    }

    public function isImage(): bool
    {
        return str_starts_with(Storage::mimeType($this->value), 'image/');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.image');
    }
}
