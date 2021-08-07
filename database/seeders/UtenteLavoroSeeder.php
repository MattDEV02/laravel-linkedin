<?php

   namespace Database\Seeders;

   use App\Models\UtenteLavoro;
   use Illuminate\Database\Seeder;


   class UtenteLavoroSeeder extends Seeder {

      private array $utentiLavori = [
         [
            'utente_id' => 1,
            'lavoro_id' => 1,
            'dataInizioLavoro' => null
         ],
         [
            'utente_id' => 2,
            'lavoro_id' => 2,
            'dataInizioLavoro' => '2020-12-12'
         ],
         [
            'utente_id' => 3,
            'lavoro_id' => 15,
            'dataInizioLavoro' => '2021-04-10'
         ],
         [
            'utente_id' => 4,
            'lavoro_id' => 7,
            'dataInizioLavoro' => '2019-11-14'
         ],
         [
            'utente_id' => 5,
            'lavoro_id' => 9,
            'dataInizioLavoro' => '2021-01-02'
         ],
         [
            'utente_id' => 6,
            'lavoro_id' => 11,
            'dataInizioLavoro' => '2021-05-17'
         ],
         [
            'utente_id' => 7,
            'lavoro_id' => 4,
            'dataInizioLavoro' => '2021-07-09'
         ],
         [
            'utente_id' => 8,
            'lavoro_id' => 8,
            'dataInizioLavoro' => '2021-07-09'
         ],
         [
            'utente_id' => 9,
            'lavoro_id' => 10,
            'dataInizioLavoro' => '2021-06-09'
         ],
         [
            'utente_id' => 10,
            'lavoro_id' => 5,
            'dataInizioLavoro' => '2021-05-19'
         ],
         [
            'utente_id' => 11,
            'lavoro_id' => 4,
            'dataInizioLavoro' => '2019-05-19'
         ],
         [
            'utente_id' => 12,
            'lavoro_id' => 1,
            'dataInizioLavoro' => null
         ],
         [
            'utente_id' => 13,
            'lavoro_id' => 12,
            'dataInizioLavoro' => '2018-08-18'
         ],
         [
            'utente_id' => 14,
            'lavoro_id' => 1,
            'dataInizioLavoro' => '2021-07-20'
         ],
      ];
      /**
       * Run the database seeds.
       *
       * @return void
       */
      public function run(): void {
         foreach($this->utentiLavori as $utenteLavoro)
            UtenteLavoro::create($utenteLavoro);
      }
   }
