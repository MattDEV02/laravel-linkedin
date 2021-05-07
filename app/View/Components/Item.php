<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Item extends Component
{
   public string $txt;
   public string $class;
   public $id;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(string $txt, string $class = '', $id = null)
   {
      $this->txt = $txt;
      $this->class = $class;
      $this->id = $id;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render()
   {
      return view('components.item');
   }
}
