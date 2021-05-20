<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCittaTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up() {
      Schema::table('Citta', function (Blueprint $table) {
         $table->foreign('nazione', 'NazioneCittaFK')->references('id')->on('nazione')->onUpdate('CASCADE')->onDelete('CASCADE');
         DB::statement('ALTER TABLE Citta ADD CONSTRAINT NomeCittaCheck CHECK (CHAR_LENGTH(nome) > 2 );');
         DB::statement("ALTER TABLE Citta COMMENT = 'Citta dove risiede l\'Utente';");
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::table('citta', function (Blueprint $table) {
         $table->dropForeign('NazioneCittaFK');
      });
   }
}
