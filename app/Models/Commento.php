<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Builder;
   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Support\Collection;
   use Illuminate\Support\Facades\DB;


   /**
    * @method static getAllByPost(int $post_id)
    * @method static getNumByPost(int $post)
    * @method static getNumTotByUtente(int $utente_id)
    * @method static getMaxByUtente(int $int)
    * @property string testo
    * @property int utente_id
    * @property int post_id
    */
   class Commento extends Model {

      protected $table = 'Commento';
      public $timestamps = true;

      public function scopeGetAllByPost(Builder $query, int $post): Collection {
         return DB::table('Commento AS c')
            ->select([
               'c.testo AS testo_commento',
               'c.created_at AS data_commento',
               'u.email AS autore_commento_email',
               DB::raw("CONCAT(u.nome, ' ', u.cognome) AS autoreCommento_nomeCognome"),
               'u.id AS autore_commento_id',
               'pr.foto AS foto_autore_commento'
            ])
            ->join('Post AS p', 'c.post_id', 'p.id')
            ->join('Utente AS u', 'c.utente_id', 'u.id')
            ->join('Utente AS up', 'p.utente_id', 'up.id')
            ->join('Profilo AS pr', 'pr.utente_id', 'u.id')
            ->where('p.id', $post)
            ->orderBy('c.created_at', 'DESC')
            ->get();
      }

      public function scopeGetNumByPost(Builder $query, int $post_id): int {
         return Commento::where('post_id', $post_id)->count() ;
      }

      public function scopeGetNumTotByUtente(Builder $query, int $utente_id): int {
         return DB::table('Commento AS c')
            ->join('Post AS p', 'c.post_id', 'p.id')
            ->join('Utente AS u', 'p.utente_id', 'u.id')
            ->where('u.id', $utente_id)
            ->count();
      }

      public function scopeGetMaxByUtente(Builder $query, int $utente_id): int {
         $rows = DB::table('Commento AS c')
            ->select(DB::raw('COUNT(c.id) AS numero_commenti'))
            ->join('Post AS p', 'c.post_id', 'p.id')
            ->join('Utente AS u', 'p.utente_id', 'u.id')
            ->where('u.id', $utente_id)
            ->groupBy('p.id')
            ->get();
         $numero_commenti = [];
         foreach($rows as $row)
            $numero_commenti[] = $row->numero_commenti;
         return max($numero_commenti);
      }
   }
