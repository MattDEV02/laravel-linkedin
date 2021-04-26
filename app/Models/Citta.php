<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;

class Citta extends Model
{
   use HasFactory;
   use PowerJoins;

   protected $table = 'Citta';
   public $timestamps = false;

   public function Nazione(): object
   {
      return $this->hasOne(Nazione::class);
   }
}
