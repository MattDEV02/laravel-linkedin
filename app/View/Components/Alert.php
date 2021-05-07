<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
   public string $msg;
   public string $ref;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(string $msg, string $ref)
   {
      $this->msg = $msg;
      $this->ref = $ref;
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
