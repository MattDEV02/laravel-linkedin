<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Utente;


class UsersSearch extends Component
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
