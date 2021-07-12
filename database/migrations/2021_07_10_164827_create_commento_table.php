<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCommentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('Commento')) {
			Schema::create('Commento', function (Blueprint $table) {
				$table->increments('id')->comment('Chiave Primaria della Tabella Commento');
				$table->unsignedInteger('post')->index('PostCommentoFK')->comment('Post su cui è stato inserito il Commento');
				$table->unsignedInteger('utente')->index('UtenteCommentoFK')->comment('Utente che ha inserito il Commento nel Post');
				$table->string('testo', 255)->comment('Testo del Commento');
				$table->timestamp('created_at')->useCurrent()->comment('Data-ora Creazione del Commento');
				$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()'))->comment('Data-ora Aggiornamento del Commento');
				 $table->unique(['post', 'utente', 'created_at'], 'PostUtenteCommento_UNIQUE');
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
         if(Schema::hasTable('Commento'))
			Schema::dropIfExists('Commento');
    }
}
