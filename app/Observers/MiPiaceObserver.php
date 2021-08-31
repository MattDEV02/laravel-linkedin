<?php

   namespace App\Observers;


   use App\Models\MiPiace;
   use App\Models\Reportistica;
   use Illuminate\Support\Facades\DB;


   class MiPiaceObserver {
      /**
       * Handle the MiPiace "created" event.
       *
       * @param MiPiace $miPiace
       * @return void
       */
      public function created(MiPiace $miPiace) {
         $utente_id = DB::table('MiPiace AS mp')
            ->select('p.utente_id')
            ->join('Post AS p', 'mp.post_id', 'p.id')
            ->where('p.id', $miPiace->post_id)
            ->first()->utente_id;
         Reportistica::updateMiPiace($utente_id);
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
