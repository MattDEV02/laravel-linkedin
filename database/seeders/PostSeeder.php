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
            'utente' => 1,
            'created_at' => '2021-05-21 17:12:55'
         ],
         [
            'id' => 2,
            'testo' => 'Forza Romaaa',
            'foto' => '2021_05_15_15_07_34.png',
            'utente' => 1,
            'created_at' => '2021-05-20 18:13:35'
         ],
         [
            'id' => 3,
            'testo' => 'Buongiorno a tutti.',
            'foto' => '2021_05_06_08_40_54.jpg',
            'utente' => 2,
            'created_at' => '2021-05-12 12:12:59'
         ],
         [
            'id' => 4,
            'testo' => 'Ecco la mia Foto di Profilo',
            'foto' => '2021_05_14_23_29_51.jpg',
            'utente' => 3,
            'created_at' => '2020-07-10 12:12:59'
         ],
         [
            'id' => 5,
            'testo' => 'Opera del Futurismo.',
            'foto' => '2021_05_06_08_38_27.jpg',
            'utente' => 4,
            'created_at' => '2019-07-10 12:12:59'
         ],
         [
            'id' => 6,
            'testo' => 'Opera del Futurismo.',
            'foto' => '2021_05_11_18_19_57.jpg',
            'utente' => 5,
            'created_at' => '2021-03-12 12:12:59'
         ],
         [
            'id' => 7,
            'testo' => 'GITHUB.',
            'foto' => '2021_05_17_21_23_34.png',
            'utente' => 3,
            'created_at' => '2021-02-12 12:12:59'
         ],
         [
            'id' => 8,
            'testo' => 'La mia Bici.',
            'foto' => '2021_05_11_18_19_59.webp',
            'utente' => 6,
            'created_at' => '2021-01-12 12:12:59'
         ]
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
