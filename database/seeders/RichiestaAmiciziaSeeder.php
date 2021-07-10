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
         'stato' => 'Accettata',
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
      ],
      [
         'id' => 8,
         'utenteMittente' => 4,
         'utenteRicevente' => 1,
         'stato' => 'Sospesa',
      ],
      [
         'id' => 9,
         'utenteMittente' => 2,
         'utenteRicevente' => 5,
         'stato' => 'Accettata',
      ],
      [
         'id' => 10,
         'utenteMittente' => 4,
         'utenteRicevente' => 6,
         'stato' => 'Accettata',
      ],
      [
         'id' => 11,
         'utenteMittente' => 2,
         'utenteRicevente' => 7,
         'stato' => 'Accettata',
      ],
      [
         'id' => 12,
         'utenteMittente' => 1,
         'utenteRicevente' => 7,
         'stato' => 'Sospesa',
      ],
      [
         'id' => 13,
         'utenteMittente' => 4,
         'utenteRicevente' => 8,
         'stato' => 'Sospesa',
      ],
      [
         'id' => 14,
         'utenteMittente' => 8,
         'utenteRicevente' => 5,
         'stato' => 'Sospesa',
      ],
      [
         'id' => 15,
         'utenteMittente' => 1,
         'utenteRicevente' => 8,
         'stato' => 'Accettata',
      ],
      [
         'id' => 16,
         'utenteMittente' => 2,
         'utenteRicevente' => 9,
         'stato' => 'Sospesa',
      ],
      [
         'id' => 17,
         'utenteMittente' => 9,
         'utenteRicevente' => 2,
         'stato' => 'Accettata',
      ],
      [
         'id' => 18,
         'utenteMittente' => 7,
         'utenteRicevente' => 9,
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
