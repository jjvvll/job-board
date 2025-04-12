<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JobInputFields extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $for = null,
        public ?bool $required = false,
        public ?string $name = null,
        public ?string $fieldName = null,
        public ?string $type = null,
        public ?string $value = null
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.job-input-fields');
    }
}
