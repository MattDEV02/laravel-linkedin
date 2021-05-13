<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Date extends Component
{
   public ?string $val;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(?string $val = null)
   {
      $this->val = $val;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render()
   {
      return view('components.date');
   }
}
