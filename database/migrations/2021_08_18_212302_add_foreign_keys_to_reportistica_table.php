<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Schema;


   class AddForeignKeysToReportisticaTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         Schema::table('Reportistica', function (Blueprint $table) {
            $table->foreign('utente_id', 'ReportisticaUtenteFK')->references('id')->on('Utente')->onUpdate('CASCADE')->onDelete('CASCADE');
            DB::statement("ALTER TABLE Reportistica COMMENT = 'Tabella contenente dati di Reportistica relativi ad un singolo Utente.';");
         });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down(): void {
         Schema::table('Reportistica', function (Blueprint $table) {
            $table->dropForeign('ReportisticaUtenteFK');
         });
      }
   }
