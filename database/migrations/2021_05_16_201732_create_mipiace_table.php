<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Schema;


   class CreateMipiaceTable extends Migration {
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up(): void {
         if(!Schema::hasTable('MiPiace')) {
            Schema::create('MiPiace', function (Blueprint $table) {
               $table->unsignedBigInteger('post_id')->index('PostMiPiaceFK')->comment('Post su cui è stato applicatto il Like');
               $table->unsignedBigInteger('utente_id')->index('UtenteMiPiaceFK')->comment('Utente che ha messo il Like al Post');
               $table->timestamp('created_at')->useCurrent()->comment('Data Creazione del Record (consente di ottenere anche la data del Mi piace del Post)');
               $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()'))->comment('Data Aggiornamento del Record');
               $table->primary(['post_id', 'utente_id', 'created_at']);
               $table->engine = 'InnoDB';
               $table->charset = 'utf8mb4';
               $table->collation = 'utf8mb4_unicode_ci';
            });
         }
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
         if(Schema::hasTable('MiPiace'))
            Schema::dropIfExists('MiPiace');
      }
   }
