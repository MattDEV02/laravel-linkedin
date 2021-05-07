<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;
use App\Models\Utente;


class UtenteLavoro extends Model
{
   use HasFactory;
   use PowerJoins;

   protected $table = 'UtenteLavoro';
   public $timestamps = false;

   public function Utente(): object {
      return $this->hasOne(Utente::class, 'id');
   }

   public function Lavoro(): object {
      return $this->hasOne(Lavoro::class);
   }
}
