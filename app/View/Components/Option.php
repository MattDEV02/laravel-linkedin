<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Option extends Component
{
   public string $nome;
   public int $id;

   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(string $nome, int $id)
   {
      $this->nome = $nome;
      $this->id = $id;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render()
   {
      return view('components.option');
   }
}
