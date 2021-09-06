<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Support\Facades\DB;


   class CreateTriggerUserLavoroProfileReportistica extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         DB::statement("
            CREATE TRIGGER UtenteLavoroProfiloReportistica_trigger AFTER INSERT ON Utente
               FOR EACH ROW
            BEGIN
               INSERT INTO Profilo(utente_id) VALUES(NEW.id);
               INSERT INTO UtenteLavoro(utente_id) VALUES(NEW.id);
               INSERT INTO Reportistica(utente_id) VALUES(NEW.id);
            END
         ");
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down(): void {
         DB::statement("DROP TRIGGER UtenteLavoroProfiloReportistica_trigger");
      }
   }
