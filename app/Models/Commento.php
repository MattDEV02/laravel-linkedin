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
               'uc.email AS autore_commento_email',
               DB::raw("CONCAT(uc.nome, ' ', uc.cognome) AS autoreCommento_nomeCognome"),
               'uc.id AS autore_commento_id',
               'duc.foto AS foto_autore_commento'
            ])
            ->join('Post AS p', 'c.post', 'p.id')
            ->join('Utente AS uc', 'c.utente', 'uc.id')
            ->join('Utente AS up', 'p.utente', 'up.id')
            ->join('DescrizioneUtente AS duc', 'duc.utente', 'uc.id')
            ->join('DescrizioneUtente AS dup', 'dup.utente', 'up.id')
            ->where('p.id', $post)
            ->orderBy('c.created_at', 'DESC')
            ->get();
      }

      public function scopeGetNumByPost(Builder $query, int $post_id): int {
         return Commento::where('post', $post_id)->count() ;
      }
   }
