<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class text extends Component
{
   public ?string $label;
   public ?string $name;
   public ?string $val;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(?string $label = null, ?string $name = 'testo', ?string $val = '')
   {
      $this->label = $label;
      $this->name = $name;
      $this->val = $val;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render(): Factory | View | Application
   {
      return view('components.text');
   }
}
