<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class collegamento extends Component
{
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public string $utenteNomeCognome;
   public string $utenteEmail;
   public string $dataInvioRichiesta;

   public function __construct(string $utenteNomeCognome, string $utenteEmail, string $dataInvioRichiesta) {
      $this->utenteNomeCognome = $utenteNomeCognome;
      $this->utenteEmail = $utenteEmail;
      $this->dataInvioRichiesta = $dataInvioRichiesta;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return View|Closure|string
    */
   public function render(): View | string | Closure {
      return view('components.collegamento');
   }
}
