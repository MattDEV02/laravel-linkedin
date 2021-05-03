<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      $posts = [
         ['testo' => 'Primo Post', 'foto' => 'private/img/test.png', 'utente' => 6],
      ];
      foreach($posts as $post)
         DB::table('Post')
            ->insert($post);
   }
}
