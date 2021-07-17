<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class LavoraPresso extends Component
{
   public string $lavoroPresso;
   public bool $cond;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(string $lavoroPresso, bool $cond = false)
   {
      $this->lavoroPresso = $lavoroPresso;
      $this->cond = $cond;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return View|Closure|string
    */
   public function render(): View | string | Closure
   {
      return view('components.lavora-presso');
   }
}
