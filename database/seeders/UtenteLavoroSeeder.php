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
      [
         'utente' => 7,
         'lavoro' => 4,
         'dataInizioLavoro' => '2021-07-09'
      ],
      [
         'utente' => 8,
         'lavoro' => 8,
         'dataInizioLavoro' => '2021-07-09'
      ],
      [
         'utente' => 9,
         'lavoro' => 10,
         'dataInizioLavoro' => '2021-06-09'
      ],
      [
         'utente' => 10,
         'lavoro' => 5,
         'dataInizioLavoro' => '2021-05-19'
      ],
      [
         'utente' => 11,
         'lavoro' => 4,
         'dataInizioLavoro' => '2019-05-19'
      ],
      [
         'utente' => 12,
         'lavoro' => 1,
         'dataInizioLavoro' => null
      ],
      [
         'utente' => 13,
         'lavoro' => 12,
         'dataInizioLavoro' => '2018-08-18'
      ],
      [
         'utente' => 14,
         'lavoro' => 1,
         'dataInizioLavoro' => '2021-07-20'
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
