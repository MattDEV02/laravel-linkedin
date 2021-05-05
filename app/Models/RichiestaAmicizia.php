<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;
use App\Models\Utente;


class RichiestaAmicizia extends Model
{
   use HasFactory;
   use PowerJoins;

   protected $table = 'RichiestaAmicizia';
   public $timestamps = true;

   public function utente(): object {
      return $this->hasOne(Utente::class);
   }

}
