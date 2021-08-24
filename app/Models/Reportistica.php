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
    * @method static updatePost($id)
    * @method static updateRichiestaAmicizia($id)
    */
   class Reportistica extends Model
   {
      use HasFactory;

      protected $table = 'Reportistica';
      public $timestamps = false;


      public function scopeUpdateCommenti(Builder $query, int $utente_id): void {
         $reportistica = Reportistica::find($utente_id);
         $reportistica->numero_tot_commenti = Commento::getNumTotByUtente($utente_id);
         $reportistica->numero_max_commenti = Commento::getMaxByUtente($utente_id);
         $reportistica->save();
      }

      public function scopeUpdateMiPiace(Builder $query, int $utente_id): void {
         $reportistica = Reportistica::find($utente_id);
         $reportistica->numero_tot_mipiace = MiPiace::getMaxByUtente($utente_id);
         $reportistica->numero_max_mipiace = MiPiace::getNumTotByUtente($utente_id);
         $reportistica->save();
      }

      public function scopeUpdatePost(Builder $query, int $utente_id): void {
         $reportistica = Reportistica::find($utente_id);
         $reportistica->numero_tot_post = Post::where('utente_id', $utente_id)->count();
         $reportistica->save();
      }

      public function scopeUpdateRichiestaAmicizia(Builder $query, int $utente_id): void {
         $reportistica = Reportistica::find($utente_id);
         $reportistica->num_tot_richieste_amicizia_inviate = RichiestaAmicizia::getNumTotRichieste($utente_id);
         $reportistica->num_tot_richieste_amicizia_ricevute =  RichiestaAmicizia::getNumTotRichieste($utente_id, false);
         $reportistica->save();
      }
   }
