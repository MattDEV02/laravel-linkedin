<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Citta;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Nazione extends Model
{
   use HasFactory;

   protected $table = 'Nazione';
   public $timestamps = false;

   public function Citta(): object
   {
      return $this->hasMany(Citta::class);
   }
}
