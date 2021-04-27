<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;


class UtenteLavoro extends Model
{
   use HasFactory;
   use PowerJoins;

   protected $table = 'UtenteLavoro';
   public $timestamps = false;

   public function Utente(): object {
      return $this->hasOne(Utente::class);
   }
   public function Lavoro(): object {
      return $this->hasOne(Lavoro::class);
   }
}
