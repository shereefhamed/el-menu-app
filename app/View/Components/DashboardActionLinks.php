<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class DashboardActionLinks extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Model $model,
        public string $editRoute,
        public ?string $restoreRoute = null,
        public ?string $deleteRoute = null,
        public ?string $forceDeleteRoute = null,
        public ?string $viewRoute = null,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-action-links');
    }
}
