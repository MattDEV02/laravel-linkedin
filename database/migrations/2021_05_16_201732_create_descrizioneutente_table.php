<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescrizioneutenteTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('descrizioneutente', function (Blueprint $table) {
         $table->increments('id')->comment('Identificativo Intero della Descrizione dell\' Utente');
         $table->string('testo', 255)->nullable()->comment('Testo della Descrizione dell\' Utente');
         $table->char('foto', 23)->nullable()->comment('Foto della Descrizione dell\' Utente (relative path del file)');
         $table->unsignedInteger('utente')->unique('utente_Utente_UNIQUE')->comment('Riferimento alla Chiava Primaria di Utente');
         $table->timestamps();
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
      Schema::dropIfExists('descrizioneutente');
   }
}
