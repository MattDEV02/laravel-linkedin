<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Builder;
   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Support\Facades\Cookie;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Log;
   use Illuminate\Support\Facades\Storage;


   /**
    * @method static getAll(int $utente_id)
    * @method static updateProfile(Request $req)
    * @property int utente_id
    */
   class Profilo extends Model {

      protected $table = 'Profilo';
      protected $primaryKey = 'utente_id';
      public $incrementing = false;
      public $timestamps = true;
      protected $fillable = ['descrizione', 'foto'];


      public function scopeGetAll(Builder $query, int $utente_id): ?object {
         return DB::table('Utente AS u')
            ->select([
               'p.descrizione',
               'p.foto',
               'u.email AS utenteEmail',
               'u.id AS utente_id',
               'ul.dataInizioLavoro',
               'l.nome AS lavoro',
               'c.nome AS citta',
               'n.nome AS nazione',
               DB::raw("CONCAT(u.nome, ' ', u.cognome) AS utenteNomeCognome"),
               DB::raw("CONCAT(l.nome, ' presso ', c.nome, ', ', n.nome, '.') AS lavoroPresso")
            ])
            ->join('Profilo AS p', 'p.utente_id', 'u.id')
            ->join('UtenteLavoro AS ul', 'ul.utente_id', 'u.id')
            ->join('Lavoro AS l', 'ul.lavoro_id', 'l.id')
            ->join('Citta AS c', 'u.citta_id', 'c.id')
            ->join('Nazione AS n', 'c.nazione_id', 'n.id' )
            ->where('u.id', $utente_id)
            ->first();
      }

      public function scopeUpdateProfile(Builder $query, Request $req): string {
         $utente_id = $req
            ->session()
            ->get('utente')->id;
         $img = $req->file('image');
         $toUpdate = [
            'descrizione' => $req->input('descrizione'),
            'foto' => null
         ];
         if(isset($img)) {
            $dir = 'profiles';
            Storage::delete(Storage::allFiles("public/$dir/$utente_id/"));
            $toUpdate['foto'] = store($img, $dir, $utente_id);
         }
         $profilo = Profilo::find($utente_id);
         $profilo->descrizione = $toUpdate['descrizione'];
         $profilo->foto = $toUpdate['foto'];
         $profilo->save();
         UtenteLavoro::where('utente_id', $utente_id)
            ->update([
               'lavoro_id' => $req->input('lavoro'),
               'dataInizioLavoro' => $req->input('dataInizioLavoro')
            ]);
         $utente = Utente::find($utente_id);
         $utente->nome = $req->input('nome');
         $utente->cognome = $req->input('cognome');
         $utente->citta_id = $req->input('citta');
         $utente->save();
         $utente->password = $req
               ->session()
               ->get('utente')->password ?? Cookie::get('password');
         sessionPutUser($req);
         return $utente->email;
      }
   }
