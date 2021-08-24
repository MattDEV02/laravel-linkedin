<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;


   class CreateReportisticaTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         if(!Schema::hasTable('Reportistica')) {
            Schema::create('Reportistica', function (Blueprint $table) {
               $table->unsignedInteger('utente_id')->primary()->comment('Riferimento alla Chiava Primaria dell\' Utente.');
               $table->unsignedBigInteger('num_tot_mipiace')->default(0)->comment('Numero totale Like di ogni Post di un Utente.');
               $table->unsignedInteger('num_max_mipiace')->default(0)->comment('Numero massimo di Like ricevuti ad un Post di un Utente.');
               $table->unsignedBigInteger('num_tot_commenti')->default(0)->comment('Numero totale Commenti di ogni Post di un Utente.');
               $table->unsignedInteger('num_max_commenti')->default(0)->comment('Numero massimo di Commenti ricevuti ad un Post di un Utente.');
               $table->unsignedInteger('num_tot_post')->default(0)->comment('Numero totale di Post pubblicati da un Utente.');
               $table->unsignedBigInteger('num_tot_richieste_amicizia_ricevute')->default(0)->comment('Numero totale Richieste Amicizia ricevute, sia in sospeso che accettate.');
               $table->unsignedBigInteger('num_tot_richieste_amicizia_inviate')->default(0)->comment('Numero totale Richieste Amicizia inviate, sia in sospeso che accettate.');
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
         if(Schema::hasTable('Reportistica')) {
            Schema::dropIfExists('Reportistica');
         }
      }
   }
