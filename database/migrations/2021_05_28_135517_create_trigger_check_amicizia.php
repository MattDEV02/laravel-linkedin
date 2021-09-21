<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Support\Facades\DB;


   class CreateTriggerCheckAmicizia extends Migration {

      private array $events = [
         'INSERT',
         'UPDATE'
      ];
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         foreach($this->events as $event)
            DB::statement("
              CREATE OR REPLACE TRIGGER CHECK_Amicizia$event BEFORE $event ON RichiestaAmicizia FOR EACH ROW
                  BEGIN
                     IF (
              SELECT
                  COUNT(ra.id)
              FROM
                  RichiestaAmicizia AS ra
                  JOIN Utente u ON ra.utenteMittente = u.id
                  JOIN Utente u2 ON ra.utenteRicevente = u2.id
              WHERE
                  (ra.utenteMittente = NEW.utenteMittente OR ra.utenteRicevente = NEW.utenteMittente) AND
                  (ra.utenteMittente = NEW.utenteRicevente OR ra.utenteRicevente = NEW.utenteRicevente) AND 
                  ra.stato = 'Accettata'
              ) > 0 THEN
                 SIGNAL SQLSTATE VALUE '99999' 
                    SET MESSAGE_TEXT = 'Richiesta Amicizia già esistente!';
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
         foreach($this->events as $event)
            DB::statement("DROP TRIGGER IF EXISTS CHECK_Amicizia$event;");
      }
   }
