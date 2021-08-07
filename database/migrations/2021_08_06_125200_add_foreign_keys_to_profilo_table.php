<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Schema;


   class AddForeignKeysToProfiloTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         Schema::table('Profilo', function (Blueprint $table) {
            $table->foreign('utente_id', 'ProfiloUtenteFK')->references('id')->on('Utente')->onUpdate('CASCADE')->onDelete('CASCADE');
            DB::statement("ALTER TABLE Profilo COMMENT = 'Profilo personale dell\'Utente';");
         });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down(): void {
         Schema::table('Profilo', function (Blueprint $table) {
            $table->dropForeign('ProfiloUtenteFK');
         });
      }
   }
