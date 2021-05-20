<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDescrizioneutenteTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::table('DescrizioneUtente', function (Blueprint $table) {
         $table->foreign('utente', 'UtenteDescrizioneFK')->references('id')->on('utente')->onUpdate('CASCADE')->onDelete('CASCADE');
         DB::statement("ALTER TABLE DescrizioneUtente COMMENT = 'Profilo personale dell\'Utente';");
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::table('descrizioneutente', function (Blueprint $table) {
         $table->dropForeign('UtenteDescrizioneFK');
      });
   }
}
