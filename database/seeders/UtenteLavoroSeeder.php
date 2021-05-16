<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UtenteLavoroSeeder extends Seeder
{
   private array $utentiLavori = [
      [
         'utente' => 12,
         'lavoro' => 1,
         'dataInizioLavoro' => null
      ]
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
