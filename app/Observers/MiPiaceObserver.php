<?php

   namespace App\Observers;


   use App\Models\MiPiace;
   use App\Models\Reportistica;


   class MiPiaceObserver {

      /**
       * Handle the MiPiace "created" event.
       *
       * @param MiPiace $miPiace
       * @return void
       */
      public function created(MiPiace $miPiace) {
         Reportistica::updateMiPiace(session()->get('utente')->id);
      }

      /**
       * Handle the MiPiace "updated" event.
       *
       * @param MiPiace $miPiace
       * @return void
       */
      public function updated(MiPiace $miPiace) {
         Reportistica::updateMiPiace(session()->get('utente')->id);
      }

      /**
       * Handle the MiPiace "deleted" event.
       *
       * @param MiPiace $miPiace
       * @return void
       */
      public function deleted(MiPiace $miPiace) {
         Reportistica::updateMiPiace(session()->get('utente')->id);
      }
   }
