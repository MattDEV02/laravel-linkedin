<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Model;


   class UtenteLavoro extends Model {

      protected $table = 'UtenteLavoro';
      protected $primaryKey = ['utente', 'Lavoro'];
      public $incrementing = false;
      public $timestamps = false;
   }
