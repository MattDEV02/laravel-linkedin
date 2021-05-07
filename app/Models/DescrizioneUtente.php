<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;
use App\Models\Utente;


class DescrizioneUtente extends Model
{
   use HasFactory;
   use PowerJoins;

   protected $table = 'DescrizioneUtente';
   public $timestamps = true;

   public function Utente(): object
   {
      return $this->hasOne(Utente::class, 'utente');
   }
}
