<?php

namespace Database\Seeders;

use Database\Seeders\CittaSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\NazioneSeeder;
use Database\Seeders\LavoroSeeder;
use Database\Seeders\UtenteSeeder;

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
         // NazioneSeeder::class,
         //CittaSeeder::class,
         //LavoroSeeder::class,
         //UtenteSeeder::class
      ]);
   }
}
