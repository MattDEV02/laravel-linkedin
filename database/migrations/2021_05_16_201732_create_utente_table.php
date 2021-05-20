<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class CreateUtenteTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      if(!Schema::hasTable('Utente')) {
         Schema::create('Utente', function (Blueprint $table) {
            $table->increments('id')->comment('Identificativo Intero dell\' Utente');
            $table->string('email', 45)->unique('Email_Utente_UNIQUE')->comment('Email dell\' Utente');
            $table->char('password', 60)->comment('Password dell\' Utente');
            $table->string('nome', 35)->comment('Nome anagrafico dell\'Utente');
            $table->string('cognome', 35)->comment('Cognome anagrafico dell\'Utente');
            $table->unsignedInteger('citta')->index('UtenteCittaFK')->comment('Riferimento alla Chiave Primaria di Citta');
            $table->timestamp('created_at')->useCurrent()->comment('Data Creazione del Record');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()'))->comment('Data Aggiornamento del Record');
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
      if(Schema::hasTable('Utente'))
         Schema::dropIfExists('Utente');
   }
}
