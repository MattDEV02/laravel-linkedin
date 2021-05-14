<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;


class MiPiaceClick extends Component
{
   public int $like;
   public int $post;
   public int $utente;
   public bool $isDisabled = false;

   public function liked(int $post, int $utente) {
      DB::table('MiPiace')
         ->insert([
            'post' => $post,
            'utente' => $utente
         ]);
      $this->like++;
      $this->isDisabled = true;
   }

   public function render()
   {
      return view('livewire.mi-piace-click');
   }
}
