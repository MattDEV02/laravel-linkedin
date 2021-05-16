<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRichiestaamiciziaTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('richiestaamicizia', function (Blueprint $table) {
         $table->increments('id')->comment('Identificativo Intero della Richiesta di Amicizia degli Utenti');
         $table->date('dataInvio')->comment('Data di Invio della Richiesta di Amicizia');
         $table->unsignedInteger('utenteMittente')->index('UtenteMittenteRichiestaAmiciziaFK')->comment('Riferimento alla Chiava Primaria dell\' Utente (mittente della richiesta di amicizia)');
         $table->unsignedInteger('utenteRicevente')->index('UtenteRiceventeRichiestaAmiciziaFK')->comment('Riferimento alla Chiava Primaria dell\' Utente (ricevente della richiesta di amicizia)');
         $table->enum('stato', ['Sospesa', 'Rifiutata', 'Accettata'])->default('Sospesa')->comment('Stato della Richiesta di Amicizia (in sospeso, rifiutata, Accettata)');
         $table->timestamp('created_at')->useCurrent()->comment('Data Creazione del Record (consente di ottenere anche la data di Pubblicazione del Post)');
         $table->timestamp('updated_at')->useCurrent()->comment('Data Aggiornamento del Record');
         $table->unique(['utenteMittente', 'utenteRicevente'], 'utenteMittenteRicevente_Utente_UNIQUE');
         $table->engine = 'InnoDB';
         $table->charset = 'utf8mb4';
         $table->collation = 'utf8mb4_unicode_ci';
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('richiestaamicizia');
   }
}
