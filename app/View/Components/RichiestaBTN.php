<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RichiestaBTN extends Component
{
   public ?bool $cond = false;
   public int $utenteMittente;
   public int $utenteRicevente;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(int $utenteMittente, int $utenteRicevente, ?bool $cond = false)
   {
      $this->cond = $cond;
      $this->utenteMittente = $utenteMittente;
      $this->utenteRicevente = $utenteRicevente;
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
