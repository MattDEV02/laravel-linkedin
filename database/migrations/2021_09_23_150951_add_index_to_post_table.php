<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Schema;


   class AddIndexToPostTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         Schema::table('Post', function (Blueprint $table) {
            $table->foreign('utente_id', 'UtentePostFK')->references('id')->on('Utente')->onUpdate('CASCADE')->onDelete('CASCADE');
            DB::statement('ALTER TABLE Post ADD CONSTRAINT CHECK_TestoPost CHECK (char_length(testo) >= 1);');
            DB::statement('ALTER TABLE Post ADD CONSTRAINT CHECK_FotoPost CHECK (char_length(foto) > 6);');
            DB::statement("ALTER TABLE Post COMMENT = 'Post pubblicati dagli Utenti';");
         });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down(): void {
         Schema::table('Post', function (Blueprint $table) {
            $table->dropForeign('UtentePostFK');
         });
      }
   }
