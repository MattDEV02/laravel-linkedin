<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DescrizioneUtenteSeeder extends Seeder {
   private array $descrizioneUtenti = [
      [
         'utente' => 12,
         'testo' => 'Ciao a tutti sono Matteo Lambertucci!!',
         'foto' => '2021_05_07_19_25_21.jpg'
      ]
   ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      foreach($this->descrizioneUtenti as $descrizioneUtente)
         DB::table('DescrizioneUtente')
            ->insert($descrizioneUtente);
   }
}
