<?php

namespace App\Observers;


use App\Models\DescrizioneUtente;
use App\Models\UtenteLavoro;
use Illuminate\Database\Eloquent\Model;

class UtenteObserver
{
   /*
    public function store(Utente $utente) {
       $id = $utente->id;
       $utenteLavoro = new UtenteLavoro();
       $utenteLavoro->utente = $id;
       $utenteLavoro->lavoro = $data->input('lavoro');
       $utenteLavoro->dataInizioLavoro = $data->input('dataInizioLavoro');
       $utenteLavoro->save();
       $descrizioneUtente = new DescrizioneUtente();
       $descrizioneUtente->utente = $id;
       $descrizioneUtente->save();
    }*/
}
