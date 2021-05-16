<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LavoroSeeder extends Seeder
{
   private array $lavori =  [
      ['nome' => 'Disoccupato'],
      ['nome' => 'Cuoco'],
      ['nome' => 'Dipendente'],
      ['nome' => 'Freelancer'],
      ['nome' => 'Calciatore'],
      ['nome' => 'Avvocato'],
      ['nome' => 'Cassiere'],
      ['nome' => 'Giudice'],
      ['nome' => 'Coltivatore'],
      ['nome' => 'Barista'],
      ['nome' => 'Imprenditore'],
      ['nome' => 'Segretario'],
      ['nome' => 'Stilista'],
      ['nome' => 'Carabiniere'],
      ['nome' => 'Poliziotto'],
   ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run() {
      foreach($this->$lavori as $lavoro)
         DB::table('Lavoro')
            ->insert($lavoro);
   }
}
