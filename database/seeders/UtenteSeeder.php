<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UtenteSeeder extends Seeder
{
   private array $utenti = [
      [
         'id' => 1,
         'email' => 'matteolambertucci3@gmail.com',
         'password' => 'mivallus',
         'nome' => 'Matteo',
         'cognome' => 'Lambertucci',
         'citta' => 1
      ],
      [
         'id' => 2,
         'email' => 'opr@gmail.com',
         'password' => 'oprrrrrr',
         'nome' => 'Alessandro',
         'cognome' => 'Oprea',
         'citta' => 4
      ],
      [
         'id' => 3,
         'email' => 'mich@gmail.com',
         'password' => 'michelee',
         'nome' => 'Michele',
         'cognome' => 'Mammucari',
         'citta' => 4
      ],
      [
         'id' => 4,
         'email' => 'carol@libero.it',
         'password' => 'mivallus',
         'nome' => 'Carol',
         'cognome' => 'Muscedere',
         'citta' => 2
      ],
      [
         'id' => 5,
         'email' => 'devak@yahoo.it',
         'password' => 'devakkkk',
         'nome' => 'Devak',
         'cognome' => 'Ballins',
         'citta' => 1
      ],
      [
         'id' => 6,
         'email' => 'jitaru@alice.it',
         'password' => 'jitaruuu',
         'nome' => 'Gabriel',
         'cognome' => 'Jitaru',
         'citta' => 9
      ]
   ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      foreach($this->utenti as $utente) {
         foreach($utente as $key => $value) {
            if($key === 'password') {
               $utente['password'] = Hash::make($value);
               DB::table('Utente')
                  ->insert($utente);
            }
         }
      }
   }
}
