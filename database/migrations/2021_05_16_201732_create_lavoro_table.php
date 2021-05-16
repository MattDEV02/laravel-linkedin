<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLavoroTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('lavoro', function (Blueprint $table) {
         $table->increments('id')->comment('Identificativo Intero del Lavoro');
         $table->string('nome', 35)->unique('nome_Lavoro_UNIQUE')->comment('Nome in formato stringa del Lavoro dell\'Utente');
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
      Schema::dropIfExists('lavoro');
   }
}
