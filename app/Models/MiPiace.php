<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Builder;
   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Support\Facades\DB;


   /**
    * @method static like(int $post_id, int $utente_id)
    * @method static isLiked(int $post_id, int $utente_id)
    * @method static getNumLikes(int $post_id)
    * @method static getNumTotByUtente(int $utente_id)
    * @method static getMaxByUtente(int $utente_id)
    * @property int post_id
    * @property int utente_id
    */
   class MiPiace extends Model {

      protected $table = 'MiPiace';
      protected $primaryKey = ['utente_id', 'post_id', 'created_at'];
      public $incrementing = false;
      public $timestamps = false;


      public function scopeIsLiked (Builder $query, int $post_id, int $utente_id): bool {
         return (bool) DB::table('MiPiace AS mp')
            ->join('Post AS p', 'mp.post_id', 'p.id')
            ->join('Utente AS u', 'mp.utente_id', 'u.id')
            ->where('p.id', $post_id)
            ->where('u.id', $utente_id)
            ->count();
      }

      public function scopeLike(Builder $query, int $post_id, int $utente_id): void {
         if(!MiPiace::isLiked($post_id, $utente_id)) {
            $miPiace = new MiPiace();
            $miPiace->post_id = $post_id;
            $miPiace->utente_id = $utente_id;
            $miPiace->save();
         }
      }

      public function scopeGetNumLikes(Builder $query, int $post_id): int {
         return DB::table('Post AS p')
            ->leftJoin('MiPiace AS mp', 'mp.post_id', 'p.id')
            ->where('mp.post_id', $post_id)
            ->count();
      }

      public function scopeGetNumTotByUtente(Builder $query, int $utente_id): int {
         return DB::table('MiPiace AS mp')
            ->leftJoin('Post AS p', 'mp.post_id', 'p.id')
            ->join('Utente AS u', 'p.utente_id', 'u.id')
            ->where('u.id', $utente_id)
            ->count();
      }

      public function scopeGetMaxByUtente(Builder $query, int $utente_id): int {
         $rows = DB::table('MiPiace AS mp')
            ->select(DB::raw('COUNT(*) AS numero_mipiace'))
            ->leftJoin('Post AS p', 'mp.post_id', 'p.id')
            ->join('Utente AS u', 'p.utente_id', 'u.id')
            ->where('u.id', $utente_id)
            ->groupBy('p.id')
            ->get();
         $numero_mipiace = [];
         foreach($rows as $row)
            $numero_mipiace[] = $row->numero_mipiace;
         return max($numero_mipiace);
      }
   }
