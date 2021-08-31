<?php

   namespace App\Models;

   use App\Models\Commento;
   use Illuminate\Database\Eloquent\Builder;
   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;


   /**
    * @method static updateCommenti(int $utente_id)
    */
   /**
    * @method static updateMiPiace(int $utente_id)
    * @method static updatePost(int $utente_id)
    * @method static updateRichiesteAmicizia(int $utente_id)
    * @method static updateCommenti(int $utente_id)
    */
   class Reportistica extends Model
   {
      use HasFactory;

      protected $table = 'Reportistica';
      protected $primaryKey = 'utente_id';
      public $incrementing = false;
      public $timestamps = false;


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
   }
