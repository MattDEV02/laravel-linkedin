<?php

namespace App\Observers;

use App\Models\Nazione;

class NazioneObserver
{
   /**
    * Handle the Nazione "created" event.
    *
    * @param  \App\Models\Nazione  $nazione
    * @return void
    */
   public function created(Nazione $nazione)
   {
      echo $nazione;
   }

   /**
    * Handle the Nazione "updated" event.
    *
    * @param  \App\Models\Nazione  $nazione
    * @return void
    */
   public function updated(Nazione $nazione)
   {
      //
   }

   /**
    * Handle the Nazione "deleted" event.
    *
    * @param  \App\Models\Nazione  $nazione
    * @return void
    */
   public function deleted(Nazione $nazione)
   {
      //
   }

   /**
    * Handle the Nazione "restored" event.
    *
    * @param  \App\Models\Nazione  $nazione
    * @return void
    */
   public function restored(Nazione $nazione)
   {
      //
   }

   /**
    * Handle the Nazione "force deleted" event.
    *
    * @param  \App\Models\Nazione  $nazione
    * @return void
    */
   public function forceDeleted(Nazione $nazione)
   {
      //
   }
}
