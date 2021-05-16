<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CittaSeeder extends Seeder
{
   private array $citta = [
      [
         'id' => 1,
         'nome' => 'Roma',
         'nazione' => 1
      ],
      [
         'id' => 2,
         'nome' => 'Milano',
         'nazione' => 1
      ],
      [
         'id' => 3,
         'nome' => 'Londra',
         'nazione' => 4
      ],
      [
         'id' => 4,
         'nome' => 'Pechino',
         'nazione' => 8
      ],
      [
         'id' => 6,
         'nome' => 'Los Angeles',
         'nazione' => 3
      ],
      [
         'id' => 7,
         'nome' => 'New York',
         'nazione' => 3
      ],
      [
         'id' => 8,
         'nome' => 'Boston',
         'nazione' => 3
      ],
      [
         'id' => 9,
         'nome' => 'Parigi',
         'nazione' => 6
      ],
      [
         'id' => 10,
         'nome' => 'Marsiglia',
         'nazione' => 6
      ],
      [
         'id' => 11,
         'nome' => 'Sydney',
         'nazione' => 9
      ],
      [
         'id' => 12,
         'nome' => 'Francoforte',
         'nazione' => 7
      ],
      [
         'id' => 13,
         'nome' => 'Tokyo',
         'nazione' => 2
      ],
   ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run() {
      foreach($this->citta as $city)
         DB::table('Citta')
            ->insert($city);
   }
}
