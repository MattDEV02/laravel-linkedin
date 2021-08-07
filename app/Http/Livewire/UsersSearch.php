<?php

   namespace App\Http\Livewire;

   use Illuminate\Contracts\Foundation\Application;
   use Illuminate\Contracts\View\Factory;
   use Illuminate\Contracts\View\View;
   use Illuminate\Support\Collection;
   use Illuminate\Support\Facades\DB;
   use Livewire\Component;
   use Illuminate\Support\Str;
   use App\Models\Utente;


   class UsersSearch extends Component {

      public Collection | array $utenti = [];

      public function search(string $s): void
      {
         $this->utenti = Str::length($s) > 0 ?
            $this->utenti = Utente::select(
               DB::raw("CONCAT(nome, ' ', cognome) AS nomeCognome"),
               'email'
            )
               ->where('nome', 'like', "$s%")
               ->orWhere('cognome', 'like', "$s%")
               ->orderBy('nome', 'ASC')
               ->orderBy('cognome', 'ASC')
               ->get() : [];
      }

      public function render(): Factory | View | Application {
         return view('livewire.users-search');
      }
   }
