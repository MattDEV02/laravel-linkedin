<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UtenteLavoroSeeder;
use Database\Seeders\CittaSeeder;
use Database\Seeders\NazioneSeeder;
use Database\Seeders\LavoroSeeder;
use Database\Seeders\UtenteSeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\DescrizioneUtenteSeeder;
use Database\Seeders\MiPiaceSeeder;
use Database\Seeders\RichiestaAmiciziaSeeder;
use Database\Seeders\CommentoSeeder;


class DatabaseSeeder extends Seeder
{
   /**
    * Seed the application's database.
    *
    * @return void
    */
   public function run()
   {
      $this->call([
         NazioneSeeder::class,
         CittaSeeder::class,
         LavoroSeeder::class,
         UtenteSeeder::class,
         UtenteLavoroSeeder::class,
         PostSeeder::class,
         DescrizioneUtenteSeeder::class,
         RichiestaAmiciziaSeeder::class,
         MiPiaceSeeder::class,
         CommentoSeeder::class
      ]);
   }
}
