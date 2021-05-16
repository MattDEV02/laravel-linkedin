<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UtenteSeeder extends Seeder
{
   private array $utenti = [
      [
         'email' => 'matteolambertucci3@gmail.com',
         'password' => 'mivallus',
         'nome' => 'Matteo',
         'cognome' => 'Lambertucci',
         'citta' => 18
      ]
   ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      foreach($this->utenti as $utente)
         DB::table('Utente')
            ->insert($utente);
   }
}
