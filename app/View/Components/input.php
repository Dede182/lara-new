<?php

namespace App\View\Components;

use Illuminate\View\Component;

class input extends Component
{
    public  $name;
    public $type;
    public $label;

    public $multiple;
    public $default;
    public $extra;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = "input_name",$type ="text",$label = "Input label",$multiple=false,$default=null,$extra="")
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->multiple = $multiple;
        $this->default = $default;
        $this->extra = $extra;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
