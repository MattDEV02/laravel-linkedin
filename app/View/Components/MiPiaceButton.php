<?php

namespace App\View\Components;

use Illuminate\View\Component;


class MiPiaceButton extends Component
{
   public int $post;
   public int $utente;
   public int $like;
   public bool $profile;
   public int $profile_id;

   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct(int $post, int $utente, int $like, bool $profile, int $profile_id = null) {
      $this->post = $post;
      $this->utente = $utente;
      $this->like = $like;
      $this->profile = $profile;
      $this->profile_id = $profile_id;
   }

   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render()
   {
      return view('components.mi-piace-button');
   }
}
