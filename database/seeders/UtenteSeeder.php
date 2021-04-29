<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UtenteSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      $utenti = [
         [
            'email' => 'matteolambertucci3@gmail.com',
            'password' => 'mivallus',
            'dataInizioLavoro' => '2021-08-10'
         ]
      ];
      foreach($utenti as $utente)
         DB::table('Utente')
            ->insert($utente);
   }
}
