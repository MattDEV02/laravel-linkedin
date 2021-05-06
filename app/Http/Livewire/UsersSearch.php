<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Utente;


class UsersSearch extends Component
{

   public string $search = '';

   public function render()
   {
      return view('livewire.users-search', [
         'utenti' => Utente::where(
            'email', 'like', "%$this->search%"
         )
            ->get(),
      ]);
   }
}
