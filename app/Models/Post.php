<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Database\Eloquent\Builder;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Str;


   /**
    * @method static pubblicazione(int $utente_id, Request $req)
    * @method static getAll(int $utente_id, false $false)
    * @method static getWithAuthor(int $post_id)
    * @property string testo
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
            p.utente AS utente_id,
	         p.foto,
            p.testo,
            p.created_at,
            CONCAT(u.nome, ' ', u.cognome) AS utente,
            CONCAT(l.nome, ' presso ', c.nome, ', ', n.nome, '.') AS lavoroPresso,
            u.email AS utenteEmail,
            COUNT(mp.id) AS miPiace,
            COUNT(cm.id) AS numero_commenti 
        FROM 
	         Post p
            LEFT JOIN MiPiace mp ON p.id = mp.post
            JOIN Utente u ON p.utente = u.id
	         LEFT JOIN Commento cm ON cm.post = p.id
            JOIN UtenteLavoro ul ON ul.utente = u.id
            JOIN Lavoro l ON ul.lavoro = l.id
            JOIN Citta c ON u.citta = c.id
            JOIN Nazione n ON c.nazione = n.id
         WHERE
            True
        GROUP BY 
            p.id
        ORDER BY 
            $orderBy 
      ");
         if($profile)
            $sql = Str::replace('True', "p.utente = $utente_id", $sql);
         return DB::select($sql);
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
            ->join('Utente AS u', 'p.utente', 'u.id')
            ->where('p.id', $post_id)
            ->first();
      }
   }
