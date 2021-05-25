<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUtenteTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::table('Utente', function (Blueprint $table) {
         $table->foreign('citta', 'UtenteCittaFK')->references('id')->on('Citta')->onUpdate('CASCADE')->onDelete('CASCADE');
         DB::statement('ALTER TABLE Utente ADD CONSTRAINT CHECK_EmailUtente CHECK (char_length(email) > 2);');
         DB::statement('ALTER TABLE Utente ADD CONSTRAINT CHECK_NomeUtente CHECK (char_length(nome) > 2);');
         DB::statement('ALTER TABLE Utente ADD CONSTRAINT CHECK_CognomeUtente CHECK (char_length(cognome) > 2);');
         DB::statement("ALTER TABLE Utente COMMENT = 'Utente del sito WEB';");
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::table('Utente', function (Blueprint $table) {
         $table->dropForeign('UtenteCittaFK');
      });
   }
}
