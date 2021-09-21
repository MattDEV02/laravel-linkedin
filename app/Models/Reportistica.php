<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Builder;
   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Support\Facades\Schema;


   /**
    * @method static updateMiPiace(int $utente_id)
    * @method static updatePost(int $utente_id)
    * @method static updateRichiesteAmicizia(int $utente_id)
    * @method static updateCommenti(int $utente_id)
    * @method static getAllRecords(): void
    * @method static getAllByUser(int $int)
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
            $data[$column] = (object) [
               'max' => Schema::hasColumn($this->table, $max_column) ?
                  $reportistica->value($max_column) : $reportistica->value($tot_column),
               'tot' => $reportistica->value($tot_column)
            ];
         }
         return (object) $data;
      }

      public function scopeGetAllRecords(Builder $query): object {
         $records = [];
         foreach($this->columns as $column) {
            $reportistica = Reportistica::all();
            $max_column =  "num_max_$column";
            $tot_column = "num_tot_$column";
            $records[$column] = (object) [
               'max' => Schema::hasColumn($this->table, $max_column) ?
                  $reportistica->max($max_column) : $reportistica->sum($tot_column),
               'tot' => $reportistica->sum($tot_column)
            ];
         }
         return (object) $records;
      }
   }
