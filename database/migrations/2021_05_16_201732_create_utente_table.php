<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Schema;


   class CreateUtenteTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         if(!Schema::hasTable('Utente')) {
            Schema::create('Utente', function (Blueprint $table) {
               $table->increments('id')->comment('Identificativo Intero dell\' Utente');
               $table->string('email', 50)->unique('Email_Utente_UNIQUE')->comment('Email dell\' Utente');
               $table->char('password', 60)->comment('Password dell\' Utente (memorizzata con bcrypt hashing)');
               $table->string('nome', 50)->comment('Nome anagrafico dell\'Utente');
               $table->string('cognome', 50)->comment('Cognome anagrafico dell\'Utente');
               $table->unsignedInteger('citta_id')->index('UtenteCittaFK')->comment('Riferimento alla Chiave Primaria di Citta');
               $table->char('api_token', env('API_TOKEN_LENGTH'))->unique()->nullable()->default(null)->comment('Token API per alcuni servizi Linkedin');
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
      public function down(): void {
         if(Schema::hasTable('Utente'))
            Schema::dropIfExists('Utente');
      }
   }
