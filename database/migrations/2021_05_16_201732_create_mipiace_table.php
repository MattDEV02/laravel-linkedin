<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateMipiaceTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      if(!Schema::hasTable('MiPiace')) {
         Schema::create('MiPiace', function (Blueprint $table) {
            $table->increments('id')->comment('Chiave Primaria della Tabella MiPiace');
            $table->unsignedInteger('post')->index('PostMiPiaceFK')->comment('Post su cui è stato applicatto il Like');
            $table->unsignedInteger('utente')->index('UtenteMiPiaceFK')->comment('Utente che ha messo il Like al Post');
            $table->unique(['post', 'utente'], 'PostUtenteMiPiace_UNIQUE');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
         });
      }
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      if(Schema::hasTable('MiPiace'))
         Schema::dropIfExists('MiPiace');
   }
}
