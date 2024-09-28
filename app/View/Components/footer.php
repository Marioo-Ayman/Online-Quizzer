<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class footer extends Component
{

    public $jsLinks = [];

    /**
     * Create a new component instance.
     */
    public function __construct($jsLinks)
    {
        // check all the file is exist
        foreach ($jsLinks as $jsLink) {
            $filePath = public_path("JS/{$jsLink}.js");
            if (file_exists($filePath)) {
                $this->jsLinks[] = $jsLink;
            } else {
                dd('no');
            }
        }

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer');
    }
}
