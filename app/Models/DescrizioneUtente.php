<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DescrizioneUtente extends Model  // Profilo dell'Utente
{
   use HasFactory;

   protected $table = 'DescrizioneUtente';
   public $timestamps = true;

}
