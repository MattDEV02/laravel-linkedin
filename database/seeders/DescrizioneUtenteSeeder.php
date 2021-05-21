<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DescrizioneUtenteSeeder extends Seeder {  // Profilo personale dell'Utente
   private array $descrizioniUtenti = [
      [
         'id' => 1,
         'utente' => 1,
         'testo' => 'Ciao a tutti mi chiamo Matteo Lambertucci e sono in cerca di Lavoro !!',
         'foto' => '2021_05_20_19_21_16.jpg'
      ],
      [
         'id' => 2,
         'utente' => 2,
         'testo' => 'Ciao a tutti mi chiamo Oprea e sono un Cuoco Cinese.',
         'foto' => '2021_05_13_11_14_14.jpg'
      ],
      [
         'id' => 3,
         'utente' => 3,
         'testo' => 'Ciao a tutti mi chiamo Michele Mammucari e sono un Poliziotto Cinese.',
         'foto' => '2021_05_13_11_05_08.jpg'
      ],
      [
         'id' => 4,
         'utente' => 4,
         'testo' => null,
         'foto' => null
      ],
      [
         'id' => 5,
         'utente' => 5,
         'testo' => 'Bella regaaa io so er Devakk',
         'foto' => '2021_05_13_11_12_22.jpg'
      ],
      [
         'id' => 6,
         'utente' => 6,
         'testo' => 'Mi chiamo JIT e sono un Imprenditore Parigino',
         'foto' => null
      ],
   ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      foreach($this->descrizioniUtenti as $descrizioneUtente)
         DB::table('DescrizioneUtente')
            ->insert($descrizioneUtente);
   }
}
