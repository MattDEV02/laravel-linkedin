<?php

   namespace Database\Seeders;

   use App\Models\Profilo;
   use Illuminate\Database\Seeder;


   class ProfiloSeeder extends Seeder {  // Profilo personale dell'utente_id

      private array $profiles = [
         [
            'utente_id' => 1,
            'descrizione' => 'Ciao a tutti mi chiamo Matteo Lambertucci e sono in cerca di Lavoro !!',
            'foto' => '2021_06_19_11_52_26.jpg'
         ],
         [
            'utente_id' => 2,
            'descrizione' => 'Ciao a tutti mi chiamo Oprea e sono un Cuoco Cinese.',
            'foto' => '2021_05_13_11_14_14.jpg'
         ],
         [
            'utente_id' => 3,
            'descrizione' => 'Ciao a tutti mi chiamo Michele Mammucari e sono un Poliziotto Cinese.',
            'foto' => '2021_05_13_11_05_08.jpg'
         ],
         [
            'utente_id' => 4,
            'descrizione' => 'Buongiorno a tutti sono Carol e mi piace il futurismo 🤣🤣🤣',
            'foto' => null
         ],
         [
            'utente_id' => 5,
            'descrizione' => 'Bella regaaa io so er Devakk',
            'foto' => '2021_05_13_11_12_22.jpg'
         ],
         [
            'utente_id' => 6,
            'descrizione' => 'Mi chiamo JIT e sono un Imprenditore Parigino',
            'foto' => null
         ],
         [
            'utente_id' => 7,
            'descrizione' => 'Bella rega io so Bruno Graziosi e faccio Biologia.  FS',
            'foto' => null
         ],
         [
            'utente_id' => 8,
            'descrizione' => 'Bella Rega, nso voi ma io so Chialastri Matteooo',
            'foto' => null
         ],
         [
            'utente_id' => 9,
            'descrizione' => 'Io so Riggi Luigi, vengo da Velletri e ovviamente tifo Roma.',
            'foto' => null
         ],
         [
            'utente_id' => 10,
            'descrizione' => 'Io so Matteo Ciarla, vengo da Velletri e ovviamente tifo Roma.',
            'foto' => null
         ],
         [
            'utente_id' => 11,
            'descrizione' => 'Buongiorno. Signori e signore sono un Freelancer di Valmontone.',
            'foto' => null
         ],
         [
            'utente_id' => 12,
            'descrizione' => 'Ciao a tutti, io mi chiamo Bea Cioc ed ho tanti problemi mentali.',
            'foto' => null
         ],
         [
            'utente_id' => 13,
            'descrizione' => 'Ciao a tutti io mi chiamo Elisa Lambertucci ed abito a Valmontone.',
            'foto' => null
         ],
         [
            'utente_id' => 14,
            'descrizione' => 'De giorno so Francesco Ballini, de notte nvece so er Devakkk',
            'foto' => null
         ],
      ];
      /**
       * Run the database seeds.
       *
       * @return void
       */
      public function run(): void {
         foreach($this->profiles as $toUpdate) {
            $profilo = Profilo::find($toUpdate['utente_id']);
            $profilo->descrizione = $toUpdate['descrizione'];
            $profilo->foto = $toUpdate['foto'];
            $profilo->save();
         }
      }
   }
