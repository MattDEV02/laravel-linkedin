<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;
use App\Models\Utente;

class Post extends Model
{
   use HasFactory;
   use PowerJoins;

   protected $table = 'Post';
   public $timestamps = true;

   public function utente(): object
   {
      return $this->hasOne(Utente::class);
   }
}
