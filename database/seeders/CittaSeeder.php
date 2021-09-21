<?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use App\Models\Citta;


   class CittaSeeder extends Seeder {
      
      private array $citta = [
         [
            'id' => 1,
            'nome' => 'Rome',
            'nazione_id' => 1
         ],
         [
            'id' => 2,
            'nome' => 'Milan',
            'nazione_id' => 1
         ],
         [
            'id' => 3,
            'nome' => 'London',
            'nazione_id' => 4
         ],
         [
            'id' => 4,
            'nome' => 'Beijing',
            'nazione_id' => 8
         ],
         [
            'id' => 5,
            'nome' => 'New Delhi',
            'nazione_id' => 5
         ],
         [
            'id' => 6,
            'nome' => 'Los Angeles',
            'nazione_id' => 3
         ],
         [
            'id' => 7,
            'nome' => 'New York',
            'nazione_id' => 3
         ],
         [
            'id' => 8,
            'nome' => 'Boston',
            'nazione_id' => 3
         ],
         [
            'id' => 9,
            'nome' => 'Paris',
            'nazione_id' => 6
         ],
         [
            'id' => 10,
            'nome' => 'Marseille',
            'nazione_id' => 6
         ],
         [
            'id' => 11,
            'nome' => 'Sydney',
            'nazione_id' => 9
         ],
         [
            'id' => 12,
            'nome' => 'Frankfurt',
            'nazione_id' => 7
         ],
         [
            'id' => 13,
            'nome' => 'Tokyo',
            'nazione_id' => 2
         ],
      ];
      /**
       * Run the database seeds.
       *
       * @return void
       */
      public function run(): void {
         foreach($this->citta as $city)
            Citta::create($city);
      }
   }
