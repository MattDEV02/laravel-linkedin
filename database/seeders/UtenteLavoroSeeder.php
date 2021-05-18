<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UtenteLavoroSeeder extends Seeder
{
   private array $utentiLavori = [
      [
         'utente' => 1,
         'lavoro' => 1,
         'dataInizioLavoro' => null
      ],
      [
         'utente' => 2,
         'lavoro' => 2,
         'dataInizioLavoro' => '2020-12-12'
      ],
      [
         'utente' => 3,
         'lavoro' => 15,
         'dataInizioLavoro' => '2021-04-10'
      ],
      [
         'utente' => 4,
         'lavoro' => 7,
         'dataInizioLavoro' => '2019-11-14'
      ],
      [
         'utente' => 5,
         'lavoro' => 9,
         'dataInizioLavoro' => '2021-01-02'
      ],
      [
         'utente' => 6,
         'lavoro' => 11,
         'dataInizioLavoro' => '2021-05-17'
      ],
   ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      foreach($this->utentiLavori as $utenteLavoro)
         DB::table('UtenteLavoro')
            ->insert($utenteLavoro);
   }
}
