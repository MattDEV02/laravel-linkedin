<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CittaSeeder extends Seeder
{
   private array $citta = [
      [
         'nome' => 'Roma',
         'nazione' => 12
      ],
      [
         'nome' => 'Milano',
         'nazione' => 12
      ],
      [
         'nome' => 'Londra',
         'nazione' => 16
      ],
      [
         'nome' => 'Pechino',
         'nazione' => 20
      ],
      [
         'nome' => 'Helsinki',
         'nazione' => 13
      ],
      [
         'nome' => 'Los Angeles',
         'nazione' => 15
      ],
      [
         'nome' => 'New York',
         'nazione' => 15
      ],
      [
         'nome' => 'Boston',
         'nazione' => 15
      ],
      [
         'nome' => 'Parigi',
         'nazione' => 18
      ],
      [
         'nome' => 'Marsiglia',
         'nazione' => 18
      ],
      [
         'nome' => 'Sydney',
         'nazione' => 21
      ],
      [
         'nome' => 'Francoforte',
         'nazione' => 19
      ],
      [
         'nome' => 'Tokyo',
         'nazione' => 14
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
