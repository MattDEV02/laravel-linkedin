<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Support\Facades\DB;


   class CreateTriggerCheckUtenteLavoroDataInizio extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         DB::statement("
            CREATE OR REPLACE TRIGGER CHECK_UtenteLavoroDataInizio BEFORE UPDATE ON UtenteLavoro
    FOR EACH ROW
BEGIN
    IF(NEW.dataInizioLavoro > CURRENT_DATE()) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'La data di inizio lavoro deve essere antecedente alla data attuale';
    END IF;
    IF (NEW.dataInizioLavoro IS NULL AND NEW.lavoro_id > 1) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Se è presente un lavoro, deve essere presente anche la data di inizio lavoro.';
    ELSEIF (NOT NEW.dataInizioLavoro IS NULL AND NEW.lavoro_id = 1) THEN
        SIGNAL SQLSTATE VALUE '99999'
            SET MESSAGE_TEXT = 'Se non è presente un lavoro, non ci deve essere la data di inizio.';
    END IF;
END 
         ");
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down(): void {
         DB::statement("DROP TRIGGER IF EXISTS CHECK_Amicizia;");
      }
   }
