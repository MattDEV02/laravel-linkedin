<?php

   namespace App\Http\Livewire;


   use Livewire\Component;
   use Illuminate\Contracts\View\Factory;
   use Illuminate\Contracts\View\View;
   use Illuminate\Contracts\Foundation\Application;
   use App\Models\RichiestaAmicizia;


   class Collegati extends Component {
      public int $utenteMittente;
      public int $utenteRicevente;
      public bool $clicked;
      private array $attr = ['utenteMittente', 'utenteRicevente'];

      public function link(int $utenteMittente, int $utenteRicevente): void {
         if(!RichiestaAmicizia::isLinked($utenteMittente, $utenteRicevente)) {
            $this->utenteMittente = $utenteMittente;
            $this->utenteRicevente = $utenteRicevente;
            $richiestaAmicizia = new RichiestaAmicizia();
            $richiestaAmicizia->utenteMittente = $this->utenteMittente;
            $richiestaAmicizia->utenteRicevente = $this->utenteRicevente;
            $richiestaAmicizia->save();
            $this->clicked = true;
         } else {
            RichiestaAmicizia::where($this->attr[0], $this->utenteMittente)
               ->where($this->attr[1], $this->utenteRicevente)
               ->delete();
         }
      }

      public function render(): Factory | View | Application {
         return view('livewire.collegati');
      }
   }
