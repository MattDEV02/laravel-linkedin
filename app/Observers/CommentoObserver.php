<?php

   namespace App\Observers;

   use App\Models\Commento;
   use App\Models\Reportistica;
   use Illuminate\Support\Facades\DB;


   class CommentoObserver {
      /**
       * Handle the Commento "created" event.
       *
       * @param Commento $commento
       * @return void
       */
      public function created(Commento $commento) {
         $utente_id = DB::table('Commento AS c')
            ->select('p.utente_id')
            ->join('Post AS p', 'c.post_id', 'p.id')
            ->where('c.id', $commento->id)
            ->first()->utente_id;
         Reportistica::updateCommenti($utente_id);
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
