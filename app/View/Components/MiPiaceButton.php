<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class MiPiaceButton extends Component
{
   public int $post;
   public int $utente;
   public int $like;
   public int $profile_id;

   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(int $post, int $utente, int $like, int $profile_id) {
      $this->post = $post;
      $this->utente = $utente;
      $this->like = $like;
      $this->profile_id = $profile_id;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render(): Factory | View | Application
   {
      return view('components.mi-piace-button');
   }
}
