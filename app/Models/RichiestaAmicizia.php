<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;


/**
 * @method static getRichieste(int $utenteRicevente)
 */
class RichiestaAmicizia extends Model
{

   protected $table = 'RichiestaAmicizia';
   public $timestamps = true;

   public function scopeGetRichieste(Builder $query, int $utente_id): ?Collection {
      return DB::table('RichiestaAmicizia AS ra')
         ->select([
            'ra.utenteMittente AS utenteMittente',
            'ra.utenteRicevente AS utenteRicevente',
            DB::raw("DATE_FORMAT(ra.created_at, '%Y-%m-%d %H:%i') AS dataInvio"),
            'ra.stato',
            'u.email',
            DB::raw("CONCAT(u.nome, ' ', u.cognome) AS utenteNomeCognome")
         ])
         ->join('Utente AS u', 'ra.utenteMittente', 'u.id')
         ->where('ra.utenteRicevente', $utente_id)
         ->where('ra.stato', 'Sospesa')
         ->orderBy('dataInvio', 'DESC')
         ->get();
   }

   public  function scopeRemoveCollegamento(Builder $query, int $utente, int $collegamento): void {
      RichiestaAmicizia::where(function($query) use ($utente) {
         $query
            ->where('utenteMittente', $utente)
            ->Orwhere('utenteRicevente', $utente);
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

   public function scopeGetCollegamenti(Builder $query, int $utente_id): Collection
   {
      return DB::table('Utente AS u')
         ->select([
            DB::raw('CONCAT(u.nome, " ", u.cognome) AS utenteNomeCognome'),
            'u.email AS utenteEmail',
            DB::raw('DATE_FORMAT(ra.created_at, "%Y-%m-%d %H:%i") AS dataInvioRichiesta')
         ])
         ->join('RichiestaAmicizia AS ra', function ($join) {
            $join
               ->on('u.id', 'ra.utenteMittente')
               ->orOn('u.id', 'ra.utenteRicevente');
         })
         ->join('Utente AS u2', 'u2.id', 'ra.utenteRicevente')
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
      $res = DB::table('RichiestaAmicizia AS ra')
         ->select(DB::raw('COUNT(ra.id) AS linked'))
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
         ->first();
      return (bool) $res->linked;
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
}
