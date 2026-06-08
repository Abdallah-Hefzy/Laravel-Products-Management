<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    /**
     * Create a new component instance.
     */

    public $type,
        $value,
        $name,
        $id;


    public function __construct($type, $name, $value, $id = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
