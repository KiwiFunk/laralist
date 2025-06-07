<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TaskCard extends Component
{
    public $task;
    public $index;

    /**
     * Create a new component instance.
     */
    public function __construct($task, int $index = 0)
    {
        $this->task = $task;
        $this->index = $index;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task-card');
    }
}
