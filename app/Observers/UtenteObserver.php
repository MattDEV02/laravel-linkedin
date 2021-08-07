<?php

   namespace App\Observers;

   use App\Models\Utente;
   use App\Models\UtenteLavoro;


   class UtenteObserver {

      public function created(Utente $utente) {
         $utenteLavoro = new UtenteLavoro();
         $utenteLavoro->utente_id = $utente->id;
         $utenteLavoro->lavoro_id = $data->input('lavoro');
         $utenteLavoro->dataInizioLavoro = $data->input('dataInizioLavoro');
         $utenteLavoro->save();
      }
   }
