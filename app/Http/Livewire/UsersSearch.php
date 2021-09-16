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

      public array | Collection $utenti;


      public function mount(): void {
         $this->utenti = [];
      }

      public function search(string $s): void {
         $this->utenti = (Str::length($s) > 0) ?
            DB::table('Utente AS u')
               ->select(
                  DB::raw("CONCAT(nome, ' ', cognome) AS nomeCognome"),
                  'u.id',
                  'u.email',
                  'p.foto'
               )
               ->join('Profilo AS p', 'p.utente_id', 'u.id')
               ->where('u.nome', 'like', "$s%")
               ->orWhere('u.cognome', 'like', "$s%")
               ->orderBy('u.nome', 'ASC')
               ->orderBy('u.cognome', 'ASC')
               ->get() : [];
      }

      public function render(): Factory | View | Application {
         return view('livewire.users-search');
      }
   }
