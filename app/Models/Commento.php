<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Builder;
   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Support\Collection;
   use Illuminate\Support\Facades\DB;


   /**
    * @method static getAllByPost(int $post_id)
    * @method static getNumByPost(int $post)
    * @property string testo
    * @property int utente
    * @property int post
    */
   class Commento extends Model {

      protected $table = 'Commento';
      public $timestamps = true;

      public function scopeGetAllByPost(Builder $query, int $post): Collection
      {
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
   }
