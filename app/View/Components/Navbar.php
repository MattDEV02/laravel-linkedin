<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
   public int $utente_id;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(int $utente_id)
   {
      $this->utente_id = $utente_id;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render()
   {
      return view('components.navbar');
   }
}
