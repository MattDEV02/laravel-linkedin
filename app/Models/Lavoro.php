<?php

namespace App\Models;

use App\Models\UtenteLavoro;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;



class Lavoro extends Model
{
   use HasFactory;
   use PowerJoins;

   protected $table = 'Lavoro';
   public $timestamps = false;

   public function UtenteLavoro(): object {
      return $this->hasOne(UtenteLavoro::class, 'lavoro');
   }

}
