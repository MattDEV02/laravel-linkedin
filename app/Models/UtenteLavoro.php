<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Model;


   /**
    * @property int utente_id
    * @property int lavoro_id
    * @property string dataInizioLavoro
    */
   class UtenteLavoro extends Model {

      protected $table = 'UtenteLavoro';
      protected $primaryKey = ['utente_id', 'lavoro_id'];
      public $incrementing = false;
      public $timestamps = false;
   }
