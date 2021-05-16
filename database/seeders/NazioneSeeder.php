<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class NazioneSeeder extends Seeder
{
   private array $nazioni =  [
      ['nome' => 'Italia'],
      ['nome' => 'Giappone'],
      ['nome' => 'Stati Uniti'],
      ['nome' => 'Inghilterra'],
      ['nome' => 'India'],
      ['nome' => 'Francia'],
      ['nome' => 'Germania'],
      ['nome' => 'Cina'],
      ['nome' => 'Australia'],
      ['nome' => 'Nuova Zelanda'],
      ['nome' => 'Svizzera'],
      ['nome' => 'Cina'],
      ['nome' => 'Finlandia']
   ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      foreach($this->nazioni as $nazione)
         DB::table('Nazione')
            ->insert($nazione);
   }
}
