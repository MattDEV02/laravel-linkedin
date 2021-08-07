<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Schema;


   class AddForeignKeysToCittaTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         Schema::table('Citta', function (Blueprint $table) {
            $table->foreign('nazione_id', 'NazioneCittaFK')->references('id')->on('Nazione')->onUpdate('CASCADE')->onDelete('CASCADE');
            DB::statement('ALTER TABLE Citta ADD CONSTRAINT NomeCittaCheck CHECK (CHAR_LENGTH(nome) > 2 );');
            DB::statement("ALTER TABLE Citta COMMENT = 'Citta dove risiede l\'Utente';");
            DB::statement('ALTER TABLE Nazione ADD CONSTRAINT NomeNazioneCheck CHECK (CHAR_LENGTH(nome) > 2 );');
         });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down(): void {
         Schema::table('Citta', function (Blueprint $table) {
            $table->dropForeign('NazioneCittaFK');
         });
      }
   }
