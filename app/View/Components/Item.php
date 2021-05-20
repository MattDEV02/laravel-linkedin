<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Item extends Component
{
   public string $txt;
   public ?string $class;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(string $txt, ?string $class = null)
   {
      $this->txt = $txt;
      $this->class = $class;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render(): Factory | View | Application
   {
      return view('components.item');
   }
}
