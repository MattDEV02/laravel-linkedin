<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Builder;
   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Support\Facades\DB;


   /**
    * @method static like(mixed $input, mixed $input1)
    * @method static isLiked(int $post, int $utente)
    * @method static getNumLikes(int $post_id)
    * @property int post
    * * @property int utente
    */
   class MiPiace extends Model {

      protected $table = 'MiPiace';
      public $timestamps = false;

      public function scopeIsLiked (Builder $query, int $post, int $utente): bool {
         return (bool) DB::table('MiPiace AS mp')
            ->join('Post AS p', 'mp.post', 'p.id')
            ->join('Utente AS u', 'mp.utente', 'u.id')
            ->where('p.id', $post)
            ->where('u.id', $utente)
            ->count();
      }

      public function scopeLike(Builder $query, int $post, int $utente): void {
         if(!MiPiace::isLiked($post, $utente)) {
            $miPiace = new MiPiace();
            $miPiace->post = $post;
            $miPiace->utente = $utente;
            $miPiace->save();
         }
      }

      public function scopeGetNumLikes(Builder $query, int $post_id): int {
         return DB::table('Post AS p')
            ->leftJoin('MiPiace AS mp', 'mp.post', 'p.id')
            ->where('mp.post', $post_id)
            ->count();
      }
   }
