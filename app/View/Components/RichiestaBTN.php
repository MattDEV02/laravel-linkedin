<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RichiestaBTN extends Component
{
   public ?bool $cond = false;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(?bool $cond = false)
   {
      $this->cond = $cond;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render()
   {
      return view('components.richiesta-b-t-n');
   }
}
