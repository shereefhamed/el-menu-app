<?php
namespace App\View\Composers;

use Illuminate\View\View;

class NavComposer
{
    public function compose(View $view)
    {
        $view->with('nav', true);
    }
}