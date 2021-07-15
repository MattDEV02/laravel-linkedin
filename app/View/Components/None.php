<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class None extends Component
{
   public string $txt;

   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(string $txt)
   {
      $this->txt = $txt;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return Application|Factory|View
    */
   public function render(): View | Factory | Application
   {
      return view('components.none');
   }
}
