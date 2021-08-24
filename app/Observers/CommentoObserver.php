<?php

   namespace App\Observers;

   use App\Models\Commento;
   use App\Models\Reportistica;


   class CommentoObserver {
      /**
       * Handle the Commento "created" event.
       *
       * @param Commento $commento
       * @return void
       */
      public function created(Commento $commento) {
         Reportistica::updateCommenti(session()->get('utente')->id);
      }

      /**
       * Handle the Commento "updated" event.
       *
       * @param Commento $commento
       * @return void
       */
      public function updated(Commento $commento) {
         Reportistica::updateCommenti(session()->get('utente')->id);
      }

      /**
       * Handle the Commento "deleted" event.
       *
       * @param Commento $commento
       * @return void
       */
      public function deleted(Commento $commento) {
         Reportistica::updateCommenti(session()->get('utente')->id);
      }
   }
