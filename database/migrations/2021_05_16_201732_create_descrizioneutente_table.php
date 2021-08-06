<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Schema;


   class CreateDescrizioneutenteTable extends Migration { // Profilo Utente
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         if(!Schema::hasTable('DescrizioneUtente')) { // IF EXISTS...
            Schema::create('DescrizioneUtente', function (Blueprint $table) {
               $table->unsignedInteger('utente')->primary()->comment('Riferimento alla Chiava Primaria di Utente');
               $table->string('testo', 255)->nullable()->comment('Testo della Descrizione dell\' Utente');
               $table->string('foto', 25)->nullable()->comment('Foto della Descrizione dell\' Utente (relative path del file)');
               $table->timestamp('created_at')->useCurrent()->comment('Data Creazione del Record (consente di ottenere anche la di creazione del Profilo)');
               $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()'))->comment('Data Aggiornamento del Profilo');
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
         if(Schema::hasTable('DescrizioneUtente')) // IF EXISTS...
            Schema::dropIfExists('DescrizioneUtente');
      }
   }
