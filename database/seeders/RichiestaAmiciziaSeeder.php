<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RichiestaAmiciziaSeeder extends Seeder
{
   private array $richieste = [
      [
         'id' => 1,
         'utenteMittente' => 3,
         'utenteRicevente' => 1,
         'stato' => 'Sospesa',
      ],
      [
         'id' => 2,
         'utenteMittente' => 2,
         'utenteRicevente' => 1,
         'stato' => 'Sospesa',
      ],
      [
         'id' => 3,
         'utenteMittente' => 4,
         'utenteRicevente' => 2,
         'stato' => 'Sospesa',
      ],
      [
         'id' => 4,
         'utenteMittente' => 1,
         'utenteRicevente' => 6,
         'stato' => 'Sospesa',
      ],
      [
         'id' => 5,
         'utenteMittente' => 5,
         'utenteRicevente' => 1,
         'stato' => 'Sospesa',
      ],
      [
         'id' => 6,
         'utenteMittente' => 2,
         'utenteRicevente' => 6,
         'stato' => 'Sospesa',
      ],
      [
         'id' => 7,
         'utenteMittente' => 3,
         'utenteRicevente' => 5,
         'stato' => 'Sospesa',
      ]
   ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      foreach($this->richieste as $richiesta)
         DB::table('RichiestaAmicizia')
            ->insert($richiesta);
   }
}
