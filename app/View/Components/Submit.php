<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Submit extends Component
{
   public string $text;
   public int $mt;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(string $text, int $mt)
   {
      $this->text = $text;
      $this->mt = $mt;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render()
   {
      return view('components.submit');
   }
}
