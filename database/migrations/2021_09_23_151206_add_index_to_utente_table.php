<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Schema;


   class AddIndexToUtenteTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         Schema::table('Utente', function (Blueprint $table) {
            $table->foreign('citta_id', 'UtenteCittaFK')->references('id')->on('Citta')->onUpdate('CASCADE')->onDelete('CASCADE');
            DB::statement('ALTER TABLE Utente ADD CONSTRAINT CHECK_EmailUtente CHECK (char_length(email) > 2);');
            DB::statement('ALTER TABLE Utente ADD CONSTRAINT CHECK_NomeUtente CHECK (char_length(nome) > 2);');
            DB::statement('ALTER TABLE Utente ADD CONSTRAINT CHECK_CognomeUtente CHECK (char_length(cognome) > 2);');
            DB::statement("ALTER TABLE Utente COMMENT = 'Utente del sito WEB';");
            DB::statement("CREATE INDEX user_account ON Utente(email, password) USING BTREE;");
         });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down(): void {
         Schema::table('Utente', function (Blueprint $table) {
            $table->dropForeign('UtenteCittaFK');
         });
      }
   }
