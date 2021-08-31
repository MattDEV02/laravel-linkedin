<?php

   namespace App\Observers;


   use App\Models\RichiestaAmicizia;
   use App\Models\Reportistica;


   class RichiestaAmiciziaObserver {
      /**
       * Handle the RichiestaAmicizia "created" event.
       *
       * @param RichiestaAmicizia $richiestaAmicizia
       * @return void
       */
      public function created(RichiestaAmicizia $richiestaAmicizia) {
         $utente_mittente = $richiestaAmicizia->utenteMittente;
         $utente_ricevente = $richiestaAmicizia->utenteRicevente;
         Reportistica::updateRichiesteAmicizia($utente_mittente, $utente_ricevente);
      }

      /**
       * Handle the RichiestaAmicizia "updated" event.
       *
       * @param RichiestaAmicizia $richiestaAmicizia
       * @return void
       */
      public function updated(RichiestaAmicizia $richiestaAmicizia) {
         Reportistica::updateRichiestaAmicizia(session()->get('utente')->id);
      }

      /**
       * Handle the RichiestaAmicizia "deleted" event.
       *
       * @param RichiestaAmicizia $richiestaAmicizia
       * @return void
       */
      public function deleted(RichiestaAmicizia $richiestaAmicizia) {
         Reportistica::updateRichiestaAmicizia(session()->get('utente')->id);
      }
   }
