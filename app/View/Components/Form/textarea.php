<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class textarea extends Component
{
    public $name, $cols, $rows, $value;

    /**
     * Create a new component instance.
     */
    public function __construct($value, string $name, int $cols = 15, int $rows = 1)
    {
        $this->value = $value;
        $this->name = $name;
        $this->cols = $cols;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.textarea');
    }
}
