<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
