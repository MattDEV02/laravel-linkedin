<?php

   namespace Database\Seeders;

   use App\Models\Nazione;
   use Illuminate\Database\Seeder;


   class NazioneSeeder extends Seeder {

      private array $nazioni =  [
         [
            'nome' => 'Italia',
            'id' => 1
         ],
         [
            'nome' => 'Giappone',
            'id' => 2,
         ],
         [
            'nome' => 'Stati Uniti',
            'id' => 3,
         ],
         [
            'nome' => 'Inghilterra',
            'id' => 4
         ],
         [
            'nome' => 'India',
            'id' => 5
         ],
         [
            'nome' => 'Francia',
            'id' => 6
         ],
         [
            'nome' => 'Germania',
            'id' => 7
         ],
         [
            'nome' => 'Cina',
            'id' => 8
         ],
         [
            'nome' => 'Australia',
            'id' => 9
         ],
         [
            'nome' => 'Nuova Zelanda',
            'id' => 10
         ],
         [
            'nome' => 'Svizzera',
            'id' => 11
         ],
         [
            'nome' => 'Finlandia',
            'id' => 12
         ]
      ];
      /**
       * Run the database seeds.
       *
       * @return void
       */
      public function run()
      {
         foreach($this->nazioni as $nazione)
            Nazione::create($nazione);
      }
   }
