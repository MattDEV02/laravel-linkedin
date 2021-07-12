<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MiPiaceSeeder extends Seeder
{
   private array $likes = [
      [
         'id' => 1,
         'post' => 1,
         'utente' => 1
      ],
      [
         'id' => 3,
         'post' => 3,
         'utente' => 2
      ]
   ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run(): void
   {
      foreach($this->likes as $like)
         DB::table('MiPiace')
            ->insert($like);
   }
}
