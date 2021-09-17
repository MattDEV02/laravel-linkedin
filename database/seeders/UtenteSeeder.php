<?php

   namespace Database\Seeders;

   use App\Models\Utente;
   use Illuminate\Database\Seeder;
   use Illuminate\Support\Facades\Hash;
   use Illuminate\Support\Str;


   class UtenteSeeder extends Seeder {

      private array $utenti = [
         [
            'id' => 1,
            'email' => 'matteolambertucci3@gmail.com',
            'password' => '12345678',
            'nome' => 'Matteo',
            'cognome' => 'Lambertucci',
            'citta_id' => 1,
            'api_token' => true
         ],
         [
            'id' => 2,
            'email' => 'opr@gmail.com',
            'password' => 'oprrrrrr',
            'nome' => 'Alessandro',
            'cognome' => 'Oprea',
            'citta_id' => 4,
            'api_token' => null
         ],
         [
            'id' => 3,
            'email' => 'mich@gmail.com',
            'password' => 'michelee',
            'nome' => 'Michele',
            'cognome' => 'Mammucari',
            'citta_id' => 4,
            'api_token' => null
         ],
         [
            'id' => 4,
            'email' => 'carol@libero.it',
            'password' => '12345678',
            'nome' => 'Carol',
            'cognome' => 'Muscedere',
            'citta_id' => 2,
            'api_token' => null
         ],
         [
            'id' => 5,
            'email' => 'devak@yahoo.it',
            'password' => 'devakkkk',
            'nome' => 'Devak',
            'cognome' => 'Ballins',
            'citta_id' => 1,
            'api_token' => null
         ],
         [
            'id' => 6,
            'email' => 'jitaru@alice.it',
            'password' => 'jitaruuu',
            'nome' => 'Gabriel',
            'cognome' => 'Jitaru',
            'citta_id' => 9,
            'api_token' => null
         ],
         [
            'id' => 7,
            'email' => 'brunograziosi@gmail.it',
            'password' => 'brunoooo',
            'nome' => 'Bruno',
            'cognome' => 'Graziosi',
            'citta_id' => 1,
            'api_token' => null
         ],
         [
            'id' => 8,
            'email' => 'chialastri02@gmail.it',
            'password' => 'chialaaa',
            'nome' => 'Matteo',
            'cognome' => 'Chialastri',
            'citta_id' => 1,
            'api_token' => null
         ],
         [
            'id' => 9,
            'email' => 'riggi@gmail.it',
            'password' => 'riggiiii',
            'nome' => 'Luigi',
            'cognome' => 'Riggi',
            'citta_id' => 10,
            'api_token' => null
         ],
         [
            'id' => 10,
            'email' => 'mattciarlax@yahoo.it',
            'password' => 'ciarlaaa',
            'nome' => 'Matteo',
            'cognome' => 'Ciarla',
            'citta_id' => 11,
            'api_token' => null
         ],
         [
            'id' => 11,
            'email' => 'richcass@libero.it',
            'password' => '12345678',
            'nome' => 'Riccardo',
            'cognome' => 'Cassanelli',
            'citta_id' => 12,
            'api_token' => null
         ],
         [
            'id' => 12,
            'email' => 'beaciocc@gmail.com',
            'password' => 'beaaaaaa',
            'nome' => 'Beatrice',
            'cognome' => 'Cioccari',
            'citta_id' => 1,
            'api_token' => null
         ],
         [
            'id' => 13,
            'email' => 'elisa@gmail.com',
            'password' => '87654321',
            'nome' => 'Elisa',
            'cognome' => 'Lambertucci',
            'citta_id' => 10,
            'api_token' => null
         ],
         [
            'id' => 14,
            'email' => 'francescoballini@alice.it',
            'password' => '09876543',
            'nome' => 'Francesco',
            'cognome' => 'Ballini',
            'citta_id' => 1,
            'api_token' => null
         ],
      ];
      /**
       * Run the database seeds.
       *
       * @return void
       */
      public function run(): void {
         $special_attributes = ['password', 'api_token'];
         foreach($this->utenti as $utente) {
            foreach($utente as $key => $value) {
               if($key === $special_attributes[0])
                  $utente[$special_attributes[0]] = Hash::make($value);
               else if($key === $special_attributes[1] && isset($value))
                  $utente[$special_attributes[1]] = Str::random(env('API_TOKEN_LENGTH'));
            }
            Utente::create($utente);
         }
      }
   }
