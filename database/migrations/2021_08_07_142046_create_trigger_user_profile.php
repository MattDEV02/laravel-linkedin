<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;
   use Illuminate\Support\Facades\DB;


   class CreateTriggerUserProfile extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         DB::statement("
            CREATE TRIGGER CreateUtente_LavoroProfile AFTER INSERT ON Utente
               FOR EACH ROW
            BEGIN
               INSERT INTO Profilo(utente_id) VALUES(NEW.id);
               INSERT INTO UtenteLavoro(utente_id, lavoro_id) VALUES(NEW.id, 1);
            END
         ");
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down(): void {
         DB::statement("DROP TRIGGER CreateUserProfile");
      }
   }
