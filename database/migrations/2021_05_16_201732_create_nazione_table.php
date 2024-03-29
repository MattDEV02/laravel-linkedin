<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;


   class CreateNazioneTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         if(!Schema::hasTable('Nazione')) {
            Schema::create('Nazione', function (Blueprint $table) {
               $table->increments('id')->comment('Identificativo Intero della Nazione');
               $table->string('nome', 35)->unique('nome_Nazione_UNIQUE')->comment('Nome in formato stringa della Nazione (identificativo)');
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
         if(Schema::hasTable('Nazione'))
            Schema::dropIfExists('Nazione');
      }
   }
