<?php

   namespace App\Http\Livewire;

   use Illuminate\Contracts\Foundation\Application;
   use Illuminate\Contracts\View\Factory;
   use Illuminate\Contracts\View\View;
   use Illuminate\Support\Collection;
   use Livewire\Component;
   use App\Models\RichiestaAmicizia;


   class RichiesteHandler extends Component {

      public Collection | array | null $richieste;
      public int $utenteMittente;
      public int $utenteRicevente;
      private array $attr = ['utenteMittente', 'utenteRicevente', 'stato'];
      private array $stato = ['Sospesa', 'Accettata'];


      public function mount(): void {
         $this->utenteRicevente = session()->get('utente')->id;
      }

      public function refresh(): void {
         $this->richieste = RichiestaAmicizia::getRichieste($this->utenteRicevente);
      }

      public function update(string $stato): void {
         RichiestaAmicizia::where($this->attr[0], $this->utenteMittente)
            ->where($this->attr[1], $this->utenteRicevente)
            ->update(['stato' => $stato]);
         $this->refresh();
      }

      public function delete(): void {
         RichiestaAmicizia::where($this->attr[2], 'Sospesa')
            ->where(function($query) {
               $query
                  ->where($this->attr[0], $this->utenteMittente)
                  ->orWhere($this->attr[1], $this->utenteMittente);
            })
            ->where(function($query) {
               $query
                  ->where($this->attr[0], $this->utenteRicevente)
                  ->orWhere($this->attr[1], $this->utenteRicevente);
            })->delete();
         $this->refresh();
      }

      public function accetta(int $utenteMittente): void {
         $this->utenteMittente = $utenteMittente;
         $this->update($this->stato[1]);
         $this->delete();
      }

      public function rifiuta(int $utenteMittente): void {
         $this->utenteMittente = $utenteMittente;
         $this->delete();
      }

      public function render(): Factory | View | Application {
         return view('livewire.richieste-handler');
      }
   }
