<?php

namespace App\View\Components;

use Illuminate\View\Component;

class header extends Component
{
    public $active;
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($active,$title)
    {
        $this->active = $active;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header');
    }
}
