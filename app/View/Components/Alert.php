<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
   public string $msg;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(string $msg )
   {
      $this->msg = $msg;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render()
   {
      return view('components.alert');
   }
}
