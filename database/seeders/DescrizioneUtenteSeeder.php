<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DescrizioneUtenteSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      $DescrizioneUtenti = [
         [
            'testo' => 'Ciao a tutti sono Matteo Lambertucci!!',
            'foto' => 'f8.jpg',
            'utente' => 12
         ]
      ];

      foreach($DescrizioneUtenti as $DescrizioneUtente)
         DB::table('DescrizioneUtente')
            ->insert($DescrizioneUtente);
   }
}
