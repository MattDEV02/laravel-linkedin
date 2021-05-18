<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RichiestaAmicizia;


class RichiesteHandler extends Component
{
   public $richieste;
   public int $utenteMittente;
   public int $utenteRicevente;
   private array $stato = ['Sospesa', 'Accettata', 'Rifiutata'];
   public bool $click = false;

   public function get(int $utenteMittente, int $utenteRicevente) {
      $this->utenteMittente = $utenteMittente;
      $this->utenteRicevente = $utenteRicevente;
   }

   public function update(string $stato) {
      $attr = ['utenteMittente', 'utenteRicevente'];
      RichiestaAmicizia::where($attr[0], $this->utenteMittente)
         ->where($attr[1], $this->utenteRicevente)
         ->update([
            'stato' => $stato
         ]);
      $this->richieste = getRichieste($this->utenteRicevente);
      $this->click = true;
   }

   public function accetta(int $utenteMittente, int $utenteRicevente) {
      $this->get($utenteMittente, $utenteRicevente);
      $this->update($this->stato[1]);
   }

   public function rifiuta(int $utenteMittente, int $utenteRicevente) {
      $this->get($utenteMittente, $utenteRicevente);
      $this->update($this->stato[2]);
   }

   public function render() {
      return view('livewire.richieste-handler');
   }
}
