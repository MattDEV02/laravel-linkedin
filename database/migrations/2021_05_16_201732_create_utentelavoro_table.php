<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;


   class CreateUtentelavoroTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         if(!Schema::hasTable('UtenteLavoro')) {
            Schema::create('UtenteLavoro', function (Blueprint $table) {
               $table->unsignedBigInteger('utente_id')->comment('Riferimento alla Chiave Primaria di Utente');
               $table->unsignedInteger('lavoro_id')->default(1)->index('LavoroUtenteFK')->comment('Riferimento alla Chiave Primaria di Lavoro');
               $table->date('dataInizioLavoro')->nullable()->comment('Data inizio Lavoro dell\' Utente');
               $table->primary(['utente_id', 'lavoro_id']);
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
         if(Schema::hasTable('UtenteLavoro'))
            Schema::dropIfExists('UtenteLavoro');
      }
   }
