<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Schema;


   class AddIndexToMipiaceTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         Schema::table('MiPiace', function (Blueprint $table) {
            $table->foreign('post_id', 'PostMiPiaceFK')->references('id')->on('Post')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('utente_id', 'UtenteMiPiaceFK')->references('id')->on('Utente')->onUpdate('CASCADE')->onDelete('CASCADE');
            DB::statement("ALTER TABLE MiPiace COMMENT = 'Like degli Utenti ai Post';");
         });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down(): void {
         Schema::table('MiPiace', function (Blueprint $table) {
            $table->dropForeign('PostMiPiaceFK');
            $table->dropForeign('UtenteMiPiaceFK');
         });
      }
   }
