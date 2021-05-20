<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class Head extends Component
{
   public string $title;
   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(string $title)
   {
      $this->title = $title;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render(): Factory | View | Application
   {
      return view('components.head');
   }
}
