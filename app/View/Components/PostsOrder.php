<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostsOrder extends Component
{
   /**
    * Create a new component instance.
    *
    * @return void
    */

   public function __construct()
   {
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return View|Closure|string
    */
   public function render(): View | string | Closure
   {
      return view('components.posts-order');
   }
}
