<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Schema;


   class CreateCommentoTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         if(!Schema::hasTable('Commento')) {
            Schema::create('Commento', function (Blueprint $table) {
               $table->increments('id')->comment('Chiave Primaria della Tabella Commento');
               $table->unsignedInteger('post_id')->index('PostCommentoFK')->comment('Post su cui è stato inserito il Commento');
               $table->unsignedInteger('utente_id')->index('UtenteCommentoFK')->comment('Utente che ha inserito il Commento nel Post');
               $table->string('testo', 255)->comment('Testo del Commento');
               $table->timestamp('created_at')->useCurrent()->comment('Data-ora Creazione del Commento');
               $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()'))->comment('Data-ora Aggiornamento del Commento');
               $table->unique(['post_id', 'utente_id', 'created_at'], 'PostUtenteCommento_UNIQUE');
               $table->engine = 'InnoDB';
               $table->charset = 'utf8mb4';
               $table->collation = 'utf8mb4_unicode_ci';
            });
            DB::statement('ALTER TABLE Commento ADD CONSTRAINT CHECK_TestoCommento CHECK (char_length(testo) >= 1);');
            DB::statement("ALTER TABLE Commento COMMENT = 'Commenti pubblicati dagli Utenti ai Post';");
         }
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down(): void {
         if(Schema::hasTable('Commento'))
            Schema::dropIfExists('Commento');
      }
   }
