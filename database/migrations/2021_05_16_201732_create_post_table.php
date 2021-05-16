<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('post', function (Blueprint $table) {
         $table->increments('id')->comment('Identificativo Intero del Post dell\' Utente');
         $table->string('testo', 255)->comment('Testo del Post dell\' Utente');
         $table->char('foto', 23)->comment('Foto del Post dell\' Utente (relativa path del file)');
         $table->unsignedInteger('utente')->comment('Riferimento alla Chiava Primaria di Utente');
         $table->timestamp('created_at')->useCurrent()->comment('Data Creazione del Record (consente di ottenere anche la di Pubblicazione del Post)');
         $table->timestamp('updated_at')->useCurrent()->comment('Data Aggiornamento del Record');
         $table->unique(['utente', 'created_at'], 'utenteCreatedAt_UtentePost_UNIQUE');
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
      Schema::dropIfExists('post');
   }
}
