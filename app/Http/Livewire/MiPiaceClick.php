<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MiPiace;


class MiPiaceClick extends Component
{
   public int $like;
   public int $post;
   public int $utente;
   public bool $isDisabled = false;

   public function liked(int $post, int $utente) {
      $miPiace = new MiPiace();
      $miPiace->post = $post;
      $miPiace->utente = $utente;
      $miPiace->save();
      $this->like++;
      $this->isDisabled = true;
   }

   public function render()
   {
      return view('livewire.mi-piace-click');
   }
}
