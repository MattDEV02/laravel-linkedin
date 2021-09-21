<?php

   namespace Database\Seeders;

   use App\Models\Nazione;
   use Illuminate\Database\Seeder;


   class NazioneSeeder extends Seeder {

      private array $nazioni =  [
         [
            'nome' => 'Italy',
            'id' => 1
         ],
         [
            'nome' => 'Japan',
            'id' => 2,
         ],
         [
            'nome' => 'United States',
            'id' => 3,
         ],
         [
            'nome' => 'England',
            'id' => 4
         ],
         [
            'nome' => 'India',
            'id' => 5
         ],
         [
            'nome' => 'France',
            'id' => 6
         ],
         [
            'nome' => 'Germany',
            'id' => 7
         ],
         [
            'nome' => 'China',
            'id' => 8
         ],
         [
            'nome' => 'Australia',
            'id' => 9
         ],
         [
            'nome' => 'New Zeland',
            'id' => 10
         ],
         [
            'nome' => 'Switzerland',
            'id' => 11
         ],
         [
            'nome' => 'Finland',
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
