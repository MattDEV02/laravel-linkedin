<?php

   namespace App\Models;

   use Illuminate\Support\Collection;
   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Database\Eloquent\Builder;


   /**
    * @method static getRichieste(int $utenteRicevente)
    * @method static isLinked(int $utenteMittente, int $utenteRicevente, bool $flag = false)
    * @method static getNumCollegamenti(int $utenteRicevente)
    * @method static isSentRichiesta(int $utenteMittente, int $utenteRicevente)
    * @method static getCollegamenti(int $utente_id)
    * @method static removeCollegamento(int $utente_id, int $idUtenteCollegamento)
    * @method static getNumTotRichieste(int $utente_id, bool $sented = true)
    * @property int utenteMittente
    * @property int utenteRicevente
    */
   class RichiestaAmicizia extends Model {

      protected $table = 'RichiestaAmicizia';
      public $timestamps = true;

      public function scopeGetRichieste(Builder $query, int $utente_id): ?Collection {
         return DB::table('RichiestaAmicizia AS ra')
            ->select([
               'ra.utenteMittente',
               DB::raw("DATE_FORMAT(ra.created_at, '%Y-%m-%d %H:%i') AS dataInvio"),
               'ra.stato',
               'u.email AS utenteMittenteEmail',
               'u.id AS utente_id',
               'p.foto AS utenteMittenteFoto',
               DB::raw("CONCAT(u.nome, ' ', u.cognome) AS utenteMittenteNomeCognome")
            ])
            ->join('Utente AS u', 'ra.utenteMittente', 'u.id')
            ->join('Profilo AS p', 'p.utente_id', 'u.id')
            ->where('ra.utenteRicevente', $utente_id)
            ->where('ra.stato', 'Sospesa')
            ->orderBy('dataInvio', 'DESC')
            ->get();
      }

      public  function scopeRemoveCollegamento(Builder $query, int $utente_id, int $collegamento): void {
         RichiestaAmicizia::where(function($query) use ($utente_id) {
            $query
               ->where('utenteMittente', $utente_id)
               ->Orwhere('utenteRicevente', $utente_id);
         })
            ->where(function($query) use ($collegamento) {
               $query
                  ->where('utenteMittente', $collegamento)
                  ->Orwhere('utenteRicevente', $collegamento);
            })
            ->where('stato', 'accettata')
            ->delete();
      }

      public function scopeIsSentRichiesta(Builder $query, int $utenteMittente, int $utenteRicevente): bool {
         return (bool) DB::table('RichiestaAmicizia AS ra')
            ->join('Utente AS u', 'ra.utenteMittente', 'u.id')
            ->join('Utente AS u2', 'ra.utenteRicevente', 'u2.id')
            ->where('ra.utenteMittente', $utenteMittente)
            ->where('ra.utenteRicevente', $utenteRicevente)
            ->where('ra.stato', 'Sospesa')
            ->count();
      }

      public function scopeGetCollegamenti(Builder $query, int $utente_id): Collection {
         return DB::table('Utente AS u')
            ->select([
               DB::raw('CONCAT(u.nome, " ", u.cognome) AS utenteNomeCognome'),
               'u.email AS utenteEmail',
               'u.id AS utente_id',
               'p.foto AS utenteFoto',
               DB::raw('DATE_FORMAT(ra.created_at, "%Y-%m-%d %H:%i") AS dataInvioRichiesta')
            ])
            ->join('RichiestaAmicizia AS ra', function ($join) {
               $join
                  ->on('ra.utenteMittente', 'u.id')
                  ->orOn('ra.utenteRicevente', 'u.id');
            })
            ->join('Utente AS u2', 'ra.utenteRicevente', 'u2.id')
            ->join('Profilo AS p', 'p.utente_id', 'u.id')
            ->where(function($query) use ($utente_id) {
               $query
                  ->where('ra.utenteRicevente', $utente_id)
                  ->Orwhere('ra.utenteMittente', $utente_id);
            })
            ->where('u.id', '<>', $utente_id)
            ->where('ra.stato', 'Accettata')
            ->get();
      }

      public function scopeIsLinked (Builder $query, int $utenteMittente, int $utenteRicevente, bool $flag = false): bool {
         $stato = $flag ? 'Sospesa' : 'Accettata';
         return (bool) DB::table('RichiestaAmicizia AS ra')
            ->join('Utente AS u', 'ra.utenteMittente', 'u.id')
            ->join('Utente AS u2', 'ra.utenteRicevente', 'u2.id')
            ->where(function($query) use ($utenteMittente) {
               $query
                  ->where('ra.utenteMittente', $utenteMittente)
                  ->Orwhere('ra.utenteRicevente', $utenteMittente);
            })
            ->where(function($query) use ($utenteRicevente) {
               $query
                  ->where('ra.utenteMittente', $utenteRicevente)
                  ->Orwhere('ra.utenteRicevente', $utenteRicevente);
            })
            ->where('ra.stato', $stato)
            ->count();
      }

      public function scopeGetNumCollegamenti(Builder $query, int $utenteRicevente): int {
         return DB::table('RichiestaAmicizia AS ra')
            ->where('ra.stato', 'Accettata')
            ->where(function($query) use ($utenteRicevente) {
               $query
                  ->where('ra.utenteRicevente', $utenteRicevente)
                  ->Orwhere('ra.utenteMittente', $utenteRicevente);
            })->count() ;
      }

      public function scopeGetNumTotRichieste(Builder $query, int $utente_id, bool $sented = true): int {
         $attr = $sented ? 'utenteMittente' : 'utenteRicevente';
         return RichiestaAmicizia::where($attr, $utente_id)->count();
      }
   }
