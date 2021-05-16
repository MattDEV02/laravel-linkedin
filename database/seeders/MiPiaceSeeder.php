<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MiPiaceSeeder extends Seeder
{
   private array $likes = [
      [
         'post' => 8,
         'utente' => 12
      ],
   ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      foreach($this->likes as $like)
         DB::table('MiPiace')
            ->insert($like);
   }
}
