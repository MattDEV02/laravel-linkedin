<?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;


   class DatabaseSeeder extends Seeder {
      /**
       * Seed the application's database.
       *
       * @return void
       */
      public function run(): void {
         $this->call([
            NazioneSeeder::class,
            CittaSeeder::class,
            LavoroSeeder::class,
            UtenteSeeder::class,
            ProfiloSeeder::class,
            UtenteLavoroSeeder::class,
            RichiestaAmiciziaSeeder::class,
            PostSeeder::class,
            MiPiaceSeeder::class,
            CommentoSeeder::class
         ]);
      }
   }
