<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class label extends Component
{

    public $for, $value;

    /**
     * Create a new component instance.
     */
    public function __construct(string $for, string $value)
    {
        $this->for = $for;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.label');
    }
}
