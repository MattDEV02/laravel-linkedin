<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Citta;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Kirschbaum\PowerJoins\PowerJoins;

class Nazione extends Model
{
   use HasFactory;
   use PowerJoins;

   protected $table = 'Nazione';
   public $timestamps = false;

   public function Citta(): object
   {
      return $this->hasMany(Citta::class, 'nazione');
   }

   public static function test(): int {
      return 1;
   }
}
