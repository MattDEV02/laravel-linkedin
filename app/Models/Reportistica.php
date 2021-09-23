<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Builder;
   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Support\Collection;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Schema;


   /**
    * @method static updateMiPiace(int $utente_id)
    * @method static updatePost(int $utente_id)
    * @method static updateRichiesteAmicizia(int $utente_id)
    * @method static updateCommenti(int $utente_id)
    * @method static getAllRecords(): void
    * @method static getAllByUser(int $int)
    * @method static usersGroupByNazione()
    * @method static getNumActionGroupByDate(int $int)
    * @method static getNumUsersGroupByNazione()
    */
   class Reportistica extends Model {
      use HasFactory;

      protected $table = 'Reportistica';
      protected $primaryKey = 'utente_id';
      public $incrementing = false;
      public $timestamps = false;
      public array $columns = [
         'mipiace',
         'commenti',
         'post',
         'richieste_amicizia_inviate',
         'richieste_amicizia_ricevute'
      ];


      public function scopeUpdateCommenti(Builder $query, int $utente_id): void {
         $reportistica = Reportistica::find($utente_id);
         $reportistica->num_tot_commenti = Commento::getNumTotByUtente($utente_id);
         $reportistica->num_max_commenti = Commento::getMaxByUtente($utente_id);
         $reportistica->save();
      }

      public function scopeUpdateMiPiace(Builder $query, int $utente_id): void {
         $reportistica = Reportistica::find($utente_id);
         $reportistica->num_tot_mipiace = MiPiace::getMaxByUtente($utente_id);
         $reportistica->num_max_mipiace = MiPiace::getNumTotByUtente($utente_id);
         $reportistica->save();
      }

      public function scopeUpdatePost(Builder $query, int $utente_id): void {
         $reportistica = Reportistica::find($utente_id);
         $reportistica->num_tot_post = Post::where('utente_id', $utente_id)->count();
         $reportistica->save();
      }

      public function scopeUpdateRichiesteAmicizia(Builder $query, int $utente_mittente, int $utente_ricevente): void {
         $reportistica_utente_mittente = Reportistica::find($utente_mittente);
         $reportistica_utente_ricevente = Reportistica::find($utente_ricevente);
         $reportistica_utente_mittente->num_tot_richieste_amicizia_inviate = RichiestaAmicizia::getNumTotRichieste($utente_mittente);
         $reportistica_utente_mittente->num_tot_richieste_amicizia_ricevute =  RichiestaAmicizia::getNumTotRichieste($utente_mittente, false);
         $reportistica_utente_mittente->save();
         $reportistica_utente_ricevente->num_tot_richieste_amicizia_inviate = RichiestaAmicizia::getNumTotRichieste($utente_ricevente);
         $reportistica_utente_ricevente->num_tot_richieste_amicizia_ricevute =  RichiestaAmicizia::getNumTotRichieste($utente_ricevente, false);
         $reportistica_utente_ricevente->save();
      }

      public function scopeGetAllByUser(Builder $query, int $utente_id): object {
         $data = [];
         $reportistica = Reportistica::find($utente_id);
         foreach($this->columns as $column) {
            $max_column =  "num_max_$column";
            $tot_column = "num_tot_$column";
            $data[$column] =  [
               'max' => Schema::hasColumn($this->table, $max_column) ?
                  $reportistica->value($max_column) : $reportistica->value($tot_column),
               'tot' => $reportistica->value($tot_column)
            ];
         }
         return (object) $data;
      }

      public function scopeGetAllRecords(Builder $query): object {
         $records = [];
         $reportistica = Reportistica::all();
         foreach($this->columns as $column) {
            $max_column =  "num_max_$column";
            $tot_column = "num_tot_$column";
            $records[$column] = [
               'max' => Schema::hasColumn($this->table, $max_column) ?
                  $reportistica->max($max_column) : $reportistica->sum($tot_column),
               'tot' => $reportistica->sum($tot_column)
            ];
         }
         return (object) $records;
      }

      public function scopeGetNumUsersGroupByNazione(Builder $query): Collection {
         return DB::table('Utente AS u')
            ->select(
               'n.nome AS Country',
               DB::raw('COUNT(u.id) AS Utenti_Linkedin')
            )
            ->join('Citta AS c', 'u.citta_id', 'c.id')
            ->join('Nazione AS n', 'c.nazione_id', 'n.id')
            ->groupBy('n.id')
            ->orderBy('Utenti_Linkedin', 'DESC')
            ->get();
      }

      public function scopeGetNumPostGroupByDate(Builder $query, int $utente_id): Collection {
         return DB::table('Utente AS u')
            ->select(
               DB::raw('DATE(p.created_at) AS data_pubblicazione'),
               DB::raw('TIME(p.created_at) AS orario_pubblicazione'),
               DB::raw('COUNT(p.id) AS num_post_pubblicati')
            )
            ->join('Post AS p', 'p.utente_id', 'u.id')
            ->where('u.id', $utente_id)
            ->groupBy('data_pubblicazione')
            ->orderBy('data_pubblicazione', 'ASC')
            ->get();
      }

      public function scopeGetNumMiPiaceGroupByDate(Builder $query, int $utente_id): Collection {
         return DB::table('Utente AS u')
            ->select(
               DB::raw('DATE(mp.created_at) AS data_like'),
               DB::raw('TIME(mp.created_at) AS orario_like'),
               DB::raw('COUNT(*) AS num_like')
            )
            ->join('MiPiace AS mp', 'mp.utente_id', 'u.id')
            ->where('u.id', $utente_id)
            ->groupBy('data_like')
            ->orderBy('data_like', 'ASC')
            ->get();
      }

      public function scopeGetNumCommentiGroupByDate(Builder $query, int $utente_id): Collection {
         return DB::table('Utente AS u')
            ->select(
               DB::raw('DATE(c.created_at) AS data_commento'),
               DB::raw('TIME(c.created_at) AS orario_commento'),
               DB::raw('COUNT(c.id) AS num_commenti')
            )
            ->join('Commento AS c', 'c.utente_id', 'u.id')
            ->where('u.id', $utente_id)
            ->groupBy('data_commento')
            ->orderBy('data_commento', 'ASC')
            ->get();
      }
   }
