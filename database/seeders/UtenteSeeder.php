<?php

   namespace Database\Seeders;

   use App\Models\Utente;
   use Illuminate\Database\Seeder;
   use Illuminate\Support\Facades\Hash;


   class UtenteSeeder extends Seeder {

      private array $utenti = [
         [
            'id' => 1,
            'email' => 'matteolambertucci3@gmail.com',
            'password' => '12345678',
            'nome' => 'Matteo',
            'cognome' => 'Lambertucci',
            'citta_id' => 1
         ],
         [
            'id' => 2,
            'email' => 'opr@gmail.com',
            'password' => 'oprrrrrr',
            'nome' => 'Alessandro',
            'cognome' => 'Oprea',
            'citta_id' => 4
         ],
         [
            'id' => 3,
            'email' => 'mich@gmail.com',
            'password' => 'michelee',
            'nome' => 'Michele',
            'cognome' => 'Mammucari',
            'citta_id' => 4
         ],
         [
            'id' => 4,
            'email' => 'carol@libero.it',
            'password' => '12345678',
            'nome' => 'Carol',
            'cognome' => 'Muscedere',
            'citta_id' => 2
         ],
         [
            'id' => 5,
            'email' => 'devak@yahoo.it',
            'password' => 'devakkkk',
            'nome' => 'Devak',
            'cognome' => 'Ballins',
            'citta_id' => 1
         ],
         [
            'id' => 6,
            'email' => 'jitaru@alice.it',
            'password' => 'jitaruuu',
            'nome' => 'Gabriel',
            'cognome' => 'Jitaru',
            'citta_id' => 9
         ],
         [
            'id' => 7,
            'email' => 'brunograziosi@gmail.it',
            'password' => 'brunoooo',
            'nome' => 'Bruno',
            'cognome' => 'Graziosi',
            'citta_id' => 1
         ],
         [
            'id' => 8,
            'email' => 'chialastri02@gmail.it',
            'password' => 'chialaaa',
            'nome' => 'Matteo',
            'cognome' => 'Chialastri',
            'citta_id' => 1
         ],
         [
            'id' => 9,
            'email' => 'riggi@gmail.it',
            'password' => 'riggiiii',
            'nome' => 'Luigi',
            'cognome' => 'Riggi',
            'citta_id' => 10
         ],
         [
            'id' => 10,
            'email' => 'mattciarlax@yahoo.it',
            'password' => 'ciarlaaa',
            'nome' => 'Matteo',
            'cognome' => 'Ciarla',
            'citta_id' => 11
         ],
         [
            'id' => 11,
            'email' => 'richcass@libero.it',
            'password' => '12345678',
            'nome' => 'Riccardo',
            'cognome' => 'Cassanelli',
            'citta_id' => 12
         ],
         [
            'id' => 12,
            'email' => 'beaciocc@gmail.com',
            'password' => 'beaaaaaa',
            'nome' => 'Beatrice',
            'cognome' => 'Cioccari',
            'citta_id' => 1
         ],
         [
            'id' => 13,
            'email' => 'elisa@gmail.com',
            'password' => '87654321',
            'nome' => 'Elisa',
            'cognome' => 'Lambertucci',
            'citta_id' => 10
         ],
         [
            'id' => 14,
            'email' => 'francescoballini@alice.it',
            'password' => '09876543',
            'nome' => 'Francesco',
            'cognome' => 'Ballini',
            'citta_id' => 1
         ],
      ];
      /**
       * Run the database seeds.
       *
       * @return void
       */
      public function run(): void {
         $attr = 'password';
         foreach($this->utenti as $utente) {
            foreach($utente as $key => $value) {
               if($key === $attr) {
                  $utente[$attr] = Hash::make($value);
                  Utente::create($utente);
               }
            }
         }
      }
   }
