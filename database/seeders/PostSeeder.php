<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PostSeeder extends Seeder
{
   private array $posts = [
      [
         'id' => 1,
         'testo' => 'Ecco il mio Primo Post.',
         'foto' => '2021_05_05_16_43_53.svg',
         'utente' => 1
      ],
      [
         'id' => 2,
         'testo' => 'Forza Romaaa',
         'foto' => '2021_05_15_15_07_34.png',
         'utente' => 1
      ],
      [
         'id' => 3,
         'testo' => 'Buongiorno a tutti.',
         'foto' => '2021_05_06_08_40_54.jpg',
         'utente' => 2
      ],
      [
         'id' => 4,
         'testo' => 'Ecco la mia Foto di Profilo',
         'foto' => '2021_05_14_23_29_51.jpg',
         'utente' => 3
      ],
      [
         'id' => 5,
         'testo' => 'Opera del Futurismo.',
         'foto' => '2021_05_06_08_38_27.jpg',
         'utente' => 4
      ],
      [
         'id' => 6,
         'testo' => 'Opera del Futurismo.',
         'foto' => '2021_05_11_18_19_57.jpg',
         'utente' => 5
      ],
   ];
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      foreach($this->posts as $post)
         DB::table('Post')
            ->insert($post);
   }
}
