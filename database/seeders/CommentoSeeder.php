<?php

   namespace Database\Seeders;

   use App\Models\Commento;
   use Illuminate\Database\Seeder;


   class CommentoSeeder extends Seeder {
      private array $comments = [
         [
            'id' => 1,
            'post_id' => 1,
            'utente_id' => 3,
            'testo' => 'Bellissimo Post !!'
         ],
         [
            'id' => 2,
            'post_id' => 2,
            'utente_id' => 3,
            'testo' => 'Forza Romaaa !!'
         ],
         [
            'id' => 3,
            'post_id' => 3,
            'utente_id' => 7,
            'testo' => 'Buongiorno a tutti i cugini'
         ],
         [
            'id' => 4,
            'post_id' => 4,
            'utente_id' => 1,
            'testo' => 'Ok'
         ],
         [
            'id' => 5,
            'post_id' => 8,
            'utente_id' => 4,
            'testo' => 'Bella bici'
         ],
         [
            'id' => 6,
            'post_id' => 6,
            'utente_id' => 2,
            'testo' => 'Viva il futurismoooo'
         ],
         [
            'id' => 7,
            'post_id' => 5,
            'utente_id' => 6,
            'testo' => 'Viva il futurismoooo'
         ],
         [
            'id' => 8,
            'post_id' => 1,
            'utente_id' => 1,
            'testo' => 'Ehh già lo so.'
         ],
         [
            'id' => 9,
            'post_id' => 7,
            'utente_id' => 1,
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
            Commento::create($comment);
      }
   }
