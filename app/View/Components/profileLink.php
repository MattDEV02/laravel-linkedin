<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class profileLink extends Component
{
   public string $utenteEmail;
   public string $utenteNomeCognome;

   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(string $utenteEmail, string $utenteNomeCognome)
   {
      $this->utenteEmail = $utenteEmail;
      $this->utenteNomeCognome = $utenteNomeCognome;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return View|Closure|string
    */
   public function render(): View | string | Closure
   {
      return view('components.profile-link');
   }
}
