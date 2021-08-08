<?php

   namespace Database\Seeders;

   use App\Models\MiPiace;
   use Illuminate\Database\Seeder;


   class MiPiaceSeeder extends Seeder {

      private array $likes = [
         [
            'post_id' => 1,
            'utente_id' => 1
         ],
         [
            'post_id' => 3,
            'utente_id' => 5
         ],
         [
            'post_id' => 8,
            'utente_id' => 5
         ],
         [
            'post_id' => 4,
            'utente_id' => 1
         ],
      ];
      /**
       * Run the database seeds.
       *
       * @return void
       */
      public function run(): void {
         foreach($this->likes as $like)
            MiPiace::create($like);
      }
   }
