<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Schema;


   class CreateDatesChecks extends Migration {

      private array $tables = [
         'Utente',
         'Post',
         'RichiestaAmicizia',
         'Commento',
         'MiPiace',
         'Profilo'
      ];

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
         foreach($this->tables  as $table) {
            foreach($this->events as $event)
               DB::statement("
                  CREATE OR REPLACE TRIGGER CHECK_timestamps_$table$event BEFORE $event ON $table FOR EACH ROW
                     BEGIN
                        IF(NEW.created_at > CURRENT_TIMESTAMP() OR NEW.updated_at > CURRENT_TIMESTAMP() OR NEW.created_at > NEW.updated_at) THEN
                           SIGNAL SQLSTATE VALUE '99999'
                           SET MESSAGE_TEXT = 'Le date di created_at e updated_at devono essere antecedenti o uguali alla data attuale.';
                        END IF;
                     END
               ");
         }
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down(): void {
         foreach($this->tables  as $table) {
            foreach($this->events as $event)
               DB::statement("DROP TRIGGER IF EXISTS CHECK_timestamps_$table$event;");
         }
      }
   }
