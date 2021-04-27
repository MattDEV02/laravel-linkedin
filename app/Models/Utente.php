<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;
use App\Models\DescrizioneUtente;
use \App\Models\UtenteLavoro;


class Utente extends Model
{
   use HasFactory;
   use powerJoins;

   protected $table = 'Utente';
   public $timestamps = true;

   private $fk = 'utente';

   public function Post(): object {
      return $this->hasMany(Post::class, $this->fk);
   }
   public function Lavoro(): object {
      return $this->hasMany(Lavoro::class, 'utente');
   }
   public function DescrizioneUtente(): object {
      return $this->hasOne(DescrizioneUtente::class, $this->fk);
   }
   public function UtenteLavoro(): object {
      return $this->hasOne(UtenteLavoro::class, 'utente');
   }
}
