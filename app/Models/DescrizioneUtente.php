<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DescrizioneUtente extends Model  // Profilo dell'Utente
{
   protected $table = 'DescrizioneUtente';
   public $timestamps = true;

   public function scopeGetProfile(Builder $query, int $utente_id): ?object
   {
      return DB::table('Utente AS u')
         ->select([
            'du.id',
            'du.testo',
            'du.foto',
            'du.updated_at',
            'u.email AS utenteEmail',
            'u.nome AS utenteName',
            'u.cognome AS utenteSurname',
            'u.id AS utente_id',
            'ul.dataInizioLavoro',
            'l.nome AS lavoro',
            'c.nome AS citta',
            'n.nome AS nazione',
            DB::raw("CONCAT(l.nome, ' presso ', c.nome, ', ', n.nome, '.') AS lavoroPresso")
         ])
         ->join('DescrizioneUtente AS du', 'du.utente', 'u.id')
         ->join('UtenteLavoro AS ul', 'ul.utente', 'u.id')
         ->join('Lavoro AS l', 'ul.lavoro', 'l.id')
         ->join('Citta AS c', 'u.citta', 'c.id')
         ->join('Nazione AS n', 'c.nazione', 'n.id' )
         ->where('u.id', $utente_id)
         ->first();
   }

   public function scopeUpdateProfile(Builder $query, Request $data): string {
      $id = $data
         ->session()
         ->get('utente')->id;
      $img = $data->file('image');
      $toUpdate = ['testo' => $data->input('testo')];
      if(isset($img)) {
         $dir = 'profiles';
         $files =  Storage::allFiles("public/$dir/$id/");
         Storage::delete($files);
         $toUpdate['foto'] = store($img , $dir, $id);
      }
      DescrizioneUtente::where(
         'utente', $id
      )->update($toUpdate);
      UtenteLavoro::where(
         'utente', $id
      )->update([
         'lavoro' => $data->input('lavoro'),
         'dataInizioLavoro' => $data->input('dataInizioLavoro')
      ]);
      $utente = Utente::find($id);
      $utente->nome = $data->input('nome');
      $utente->cognome = $data->input('cognome');
      $utente->citta = $data->input('citta');
      $utente->save();
      $data
         ->session()
         ->put('utente', $utente);
      return $utente->email;
   }
}
