<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class subtitle extends Component
{
   public string $txt;

   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(string $txt) {
      $this->txt = $txt;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return View|Closure|string
    */
   public function render(): View | string | Closure
   {
      return view('components.subtitle');
   }
}
