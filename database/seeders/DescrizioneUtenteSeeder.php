<?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use Illuminate\Support\Facades\DB;


   class DescrizioneUtenteSeeder extends Seeder {  // Profilo personale dell'Utente
      private array $descrizioniUtenti = [
         [
            'utente' => 1,
            'testo' => 'Ciao a tutti mi chiamo Matteo Lambertucci e sono in cerca di Lavoro !!',
            'foto' => '2021_06_19_11_52_26.jpg'
         ],
         [
            'utente' => 2,
            'testo' => 'Ciao a tutti mi chiamo Oprea e sono un Cuoco Cinese.',
            'foto' => '2021_05_13_11_14_14.jpg'
         ],
         [
            'utente' => 3,
            'testo' => 'Ciao a tutti mi chiamo Michele Mammucari e sono un Poliziotto Cinese.',
            'foto' => '2021_05_13_11_05_08.jpg'
         ],
         [
            'utente' => 4,
            'testo' => 'Buongiorno a tutti sono Carol e mi piace il futurismo 🤣🤣🤣',
            'foto' => null
         ],
         [
            'utente' => 5,
            'testo' => 'Bella regaaa io so er Devakk',
            'foto' => '2021_05_13_11_12_22.jpg'
         ],
         [
            'utente' => 6,
            'testo' => 'Mi chiamo JIT e sono un Imprenditore Parigino',
            'foto' => null
         ],
         [
            'utente' => 7,
            'testo' => 'Bella rega io so Bruno Graziosi e faccio Biologia.  FS',
            'foto' => null
         ],
         [
            'utente' => 8,
            'testo' => 'Bella Rega, nso voi ma io so Chialastri Matteooo',
            'foto' => null
         ],
         [
            'utente' => 9,
            'testo' => 'Io so Riggi Luigi, vengo da Velletri e ovviamente tifo Roma.',
            'foto' => null
         ],
         [
            'utente' => 10,
            'testo' => 'Io so Matteo Ciarla, vengo da Velletri e ovviamente tifo Roma.',
            'foto' => null
         ],
         [
            'utente' => 11,
            'testo' => 'Buongiorno. Signori e signore sono un Freelancer di Valmontone.',
            'foto' => null
         ],
         [
            'utente' => 12,
            'testo' => 'Ciao a tutti, io mi chiamo Bea Cioc ed ho tanti problemi mentali.',
            'foto' => null
         ],
         [
            'utente' => 13,
            'testo' => 'Ciao a tutti io mi chiamo Elisa Lambertucci ed abito a Valmontone.',
            'foto' => null
         ],
         [
            'utente' => 14,
            'testo' => 'De giorno so Francesco Ballini, de notte nvece so er Devakkk',
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
