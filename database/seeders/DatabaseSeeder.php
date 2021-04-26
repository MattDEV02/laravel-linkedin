<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\NazioneSeeder;
use Database\Seeders\CittaSeeder;

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
         CittaSeeder::class
      ]);
   }
}
