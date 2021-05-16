<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCittaTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('citta', function (Blueprint $table) {
         $table->increments('id')->comment('Identificativo Intero della Citta');
         $table->string('nome', 35)->comment('Nome in formato stringa della Citta');
         $table->unsignedInteger('nazione')->index('NazioneCittaFK')->comment('Riferimento alla Chiava Primaria di Nazione');
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
      Schema::dropIfExists('citta');
   }
}
