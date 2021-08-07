<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Database\Eloquent\Builder;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\DB;


   /**
    * @method static pubblicazione(int $utente_id, Request $req)
    * @method static getAll(int $utente_id, bool $profile = false, string $orderBy = 'p.created_at DESC')
    * @method static getWithAuthor(int $post_id)
    * @method static getNumLikes()
    * @property string testo
    * @property string foto
    * @property int utente
    */
   class Post extends Model {

      protected $table = 'Post';
      public $timestamps = true;

      public function scopePubblicazione(Builder $query, int $utente, Request $data): string {
         $fileName = store($data->file('image'), 'posts', $utente);
         $post = new Post();
         $post->testo= $data->input('testo');
         $post->foto = $fileName;
         $post->utente = $utente;
         $post->save();
         return "$utente/$fileName";
      }

      public function scopeGetAll(Builder $query, int $utente_id, bool $profile = false, $orderBy = 'p.created_at DESC'): array {
         $sql = ("
            SELECT 
               p.id,
               u.id AS utente_id,
               p.foto,
               p.testo,
               p.created_at,
               u.email AS utenteEmail,
               CONCAT(u.nome, ' ', u.cognome) AS utenteNomeCognome,
               CONCAT(l.nome, ' presso ', c.nome, ', ', n.nome, '.') AS lavoroPresso
           FROM 
              Post p
              JOIN Utente u ON p.utente_id = u.id
              LEFT JOIN RichiestaAmicizia ra ON (ra.utenteMittente = u.id OR ra.utenteRicevente = u.id)
              JOIN UtenteLavoro ul ON ul.utente_id = u.id
              JOIN Lavoro l ON ul.lavoro_id = l.id
              JOIN Citta c ON u.citta_id = c.id
              JOIN Nazione n ON c.nazione_id = n.id
           WHERE
               ra.stato = 'Accettata' AND
              (ra.utenteMittente = $utente_id OR ra.utenteRicevente = $utente_id)
           GROUP BY
              p.id
           ORDER BY 
               $orderBy 
      ");
         if($profile)
            $sql = Post::getSQLQuery_postsByProfile($utente_id, $orderBy);
         return DB::select($sql);
      }

      public static function getSQLQuery_postsByProfile(int $profile, string $orderBy): string {
         return ("
            SELECT 
                  p.id,
                  u.id AS utente_id,
                  p.foto,
                  p.testo,
                  p.created_at,
                  u.email AS utenteEmail, 
                  CONCAT(u.nome, ' ', u.cognome) AS utenteNomeCognome,
                  CONCAT(l.nome, ' presso ', c.nome, ', ', n.nome, '.') AS lavoroPresso
               FROM
                   Post p
                       JOIN Utente u ON p.utente_id = u.id
                       JOIN UtenteLavoro ul ON ul.utente_id = u.id
                       JOIN Lavoro l ON ul.lavoro_id = l.id
                       JOIN Citta c ON u.citta_id = c.id
                       JOIN Nazione n ON c.nazione_id = n.id
               WHERE
                   u.id = $profile
               ORDER BY
                   $orderBy
         ");
      }

      public function scopeGetWithAuthor(Builder $query, int $post_id): array {
         return (array) DB::table('Post AS p')
            ->select([
               'p.id',
               'p.foto',
               'p.testo',
               'p.created_at',
               'u.id AS autore_id',
               'u.email AS autore_email',
               DB::raw("CONCAT(u.nome, ' ', u.cognome) AS autore_nomeCognome")
            ])
            ->join('Utente AS u', 'p.utente_id', 'u.id')
            ->where('p.id', $post_id)
            ->first();
      }
   }
