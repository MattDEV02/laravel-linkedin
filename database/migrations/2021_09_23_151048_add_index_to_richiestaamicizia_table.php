<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Schema;


   class AddIndexToRichiestaamiciziaTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         Schema::table('RichiestaAmicizia', function (Blueprint $table) {
            $table->foreign('utenteMittente', 'UtenteMittenteRichiestaAmiciziaFK')->references('id')->on('Utente')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('utenteRicevente', 'UtenteRiceventeRichiestaAmiciziaFK')->references('id')->on('Utente')->onUpdate('CASCADE')->onDelete('CASCADE');
            DB::statement("ALTER TABLE RichiestaAmicizia COMMENT = 'Richieste di Amicizia inviate da un Utente ad un altro';");
         });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down(): void {
         Schema::table('RichiestaAmicizia', function (Blueprint $table) {
            $table->dropForeign('UtenteMittenteRichiestaAmiciziaFK');
            $table->dropForeign('UtenteRiceventeRichiestaAmiciziaFK');
         });
      }
   }
