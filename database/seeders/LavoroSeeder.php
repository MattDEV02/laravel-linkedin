<?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use App\Models\Lavoro;


   class LavoroSeeder extends Seeder {
      private array $lavori =  [
         [
            'id' => 1,
            'nome' => 'Disoccupato'
         ],
         [
            'id' => 2,
            'nome' => 'Cuoco'
         ],
         [
            'id' => 3,
            'nome' => 'Dipendente'
         ],
         [
            'id' => 4,
            'nome' => 'Freelancer'
         ],
         [
            'id' => 5,
            'nome' => 'Calciatore'
         ],
         [
            'id' => 6,
            'nome' => 'Avvocato'
         ],
         [
            'id' => 7,
            'nome' => 'Cassiere'
         ],
         [
            'id' => 8,
            'nome' => 'Giudice'
         ],
         [
            'id' => 9,
            'nome' => 'Coltivatore'
         ],
         [
            'id' => 10,
            'nome' => 'Barista'
         ],
         [
            'id' => 11,
            'nome' => 'Imprenditore'
         ],
         [
            'id' => 12,
            'nome' => 'Segretario'
         ],
         [
            'id' => 13,
            'nome' => 'Stilista'
         ],
         [
            'id' => 14,
            'nome' => 'Carabiniere'
         ],
         [
            'id' => 15,
            'nome' => 'Poliziotto'
         ],
      ];
      /**
       * Run the database seeds.
       *
       * @return void
       */
      public function run() {
         foreach($this->lavori as $lavoro)
            Lavoro::create($lavoro);
      }
   }
