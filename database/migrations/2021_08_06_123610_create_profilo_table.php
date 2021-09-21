<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;
   use Illuminate\Support\Facades\DB;


   class CreateProfiloTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         if(!Schema::hasTable('Profilo')) { // IF EXISTS...
            Schema::create('Profilo', function (Blueprint $table) {
               $table->unsignedBigInteger('utente_id')->primary()->comment('Riferimento alla Chiava Primaria di Utente e chiave primaria del Profilo');
               $table->string('descrizione', 255)->nullable()->comment('Testo della Descrizione del Profilo Utente');
               $table->string('foto', 25)->nullable()->comment('Foto del Profilo (relativa path del file)');
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
         if(Schema::hasTable('Profilo')) {
            Schema::dropIfExists('Profilo');}
      }
   }
