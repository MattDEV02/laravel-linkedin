<?php

namespace App\Http\Livewire;

use App\Models\Utente;
use Livewire\Component;


class Counter extends Component
{
   public $utenti = [];

   public function search(string $s)
   {
      $this->utenti = Utente::where(
         'email', 'like', "$s%"
      )->get();
   }

   public function render()
   {
      return view('livewire.counter');
   }
}