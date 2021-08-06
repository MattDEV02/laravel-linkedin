<?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use Illuminate\Support\Facades\DB;


   class CommentoSeeder extends Seeder
   {
      private array $comments = [
         [
            'id' => 1,
            'post' => 1,
            'utente' => 3,
            'testo' => 'Bellissimo Post !!'
         ],
         [
            'id' => 2,
            'post' => 2,
            'utente' => 3,
            'testo' => 'Forza Romaaa !!'
         ],
         [
            'id' => 3,
            'post' => 3,
            'utente' => 7,
            'testo' => 'Buongiorno a tutti i cugini'
         ],
         [
            'id' => 4,
            'post' => 4,
            'utente' => 1,
            'testo' => 'Ok'
         ],
         [
            'id' => 5,
            'post' => 8,
            'utente' => 4,
            'testo' => 'Bella bici'
         ],
         [
            'id' => 6,
            'post' => 6,
            'utente' => 2,
            'testo' => 'Viva il futurismoooo'
         ],
         [
            'id' => 7,
            'post' => 5,
            'utente' => 6,
            'testo' => 'Viva il futurismoooo'
         ],
         [
            'id' => 8,
            'post' => 1,
            'utente' => 1,
            'testo' => 'Ehh già lo so.'
         ],
         [
            'id' => 9,
            'post' => 7,
            'utente' => 1,
            'testo' => 'Molto utile.'
         ],
      ];
      /**
       * Run the database seeds.
       *
       * @return void
       */
      public function run(): void
      {
         foreach($this->comments as $comment)
            DB::table('Commento')
               ->insert($comment);
      }
   }
