<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class AddForeignKeysToUtentelavoroTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::table('UtenteLavoro', function (Blueprint $table) {
         $table->foreign('lavoro', 'LavoroUtenteFK')->references('id')->on('Lavoro')->onUpdate('CASCADE')->onDelete('CASCADE');
         $table->foreign('utente', 'UtenteLavoroFK')->references('id')->on('Utente')->onUpdate('CASCADE')->onDelete('CASCADE');
         DB::statement("ALTER TABLE UtenteLavoro COMMENT = 'Relazione contenente le Chiavi Primarie della Relazione Utente e della Relazione Lavoro';");
         DB::statement("ALTER TABLE Nazione COMMENT = 'Nazione dove risiede l\'Utente';");
         DB::statement("ALTER TABLE Lavoro COMMENT = 'Relazione contentente diversi tipi di Lavoro che possono essere svolti dall\'Utente';");
         DB::statement("CREATE INDEX user_account ON Utente(email, password) USING BTREE;");
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::table('UtenteLavoro', function (Blueprint $table) {
         $table->dropForeign('LavoroUtenteFK');
         $table->dropForeign('UtenteLavoroFK');
      });
   }
}
