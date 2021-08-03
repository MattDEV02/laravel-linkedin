<?php

   use App\Models\DescrizioneUtente;
   use App\Models\MiPiace;
   use App\Models\Utente;
   use Illuminate\Http\Client\RequestException;
   use Illuminate\Http\Request;
   use Illuminate\Support\Arr;
   use Illuminate\Support\Facades\Http;
   use Illuminate\Support\Facades\Log;
   use Illuminate\Support\Facades\Storage;
   use JetBrains\PhpStorm\Pure;
   use Symfony\Component\Console\Output\ConsoleOutput;
   use Illuminate\Support\Str;
   use App\Models\RichiestaAmicizia;
   use Illuminate\Http\Client\Response;


   if(
      !function_exists('selectors') &&
      !function_exists('consoleLog') &&
      !function_exists('sendMail') &&
      !function_exists('checkRef') &&
      !function_exists('store') &&
      !function_exists('isLiked') &&
      !function_exists('isLinked') &&
      !function_exists('getNumCollegamenti') &&
      !function_exists('isSentRichiesta') &&
      !function_exists('checkDataInizioLavoroErrors') &&
      !function_exists('isValidCollection') &&
      !function_exists('isValidResponse') &&
      !function_exists('adjustEmail') &&
      !function_exists('getProfileImage') &&
      !function_exists('sessionPutUser')
   ) {
      function selectors(): array {
         $imgFolder = 'img';
         $fd = 'public';
         return [
            'lang' =>  Str::replace('_', '-', app()->getLocale()),
            'dir' => 'ltr',
            'charset' => 'UTF-8',
            'app' => config('app.name'),
            'author' => 'Matteo Lambertucci <matteolambertucci3@gmail.com>',
            'icons' => [
               'ico' => "$imgFolder/favicon.ico",
               'png' => "$imgFolder/logo.png",
               'svg' => "$imgFolder/logo.svg",
            ],
            'theme-color' => '#000000',
            'container' => 'container-fluid',
            'col' => 'col-12 mt-',
            'row' => 'row justify-content-center',
            'fw' => 'font-weight-bold',
            'border' => 'border border-dark',
            'method' => 'POST',
            'action' => 'ricezione-dati',
            'input' => 'form-control form-control-lg border border-dark inputTXT',
            'btn' => 'btn btn-lg',
            'email' => 'email',
            'pass' => 'password',
            'date' => 'dataInizioLavoro',
            'img' => 'image',
            'txt' => 'testo',
            'select1' => 'lavoro',
            'select2' => 'citta',
            'emailLen' => 35,
            'passLen' => 8,
            'autocomplete' => 'off',
            'title' => 'Clicca per Mostrare / Nascondere la Password',
            'fd' => $fd,
            'storage' => "$fd/storage/",
            'table' => 'table table-hover text-center table-bordered',
            'show-profile' => '/show-profile?search='
         ];
      }
      function consoleLog(mixed $s): string
      {
         $s = strval($s);
         $out = new ConsoleOutput();
         $out->writeln("<info>$s</info>");
         return $s;
      }
      function sendmail(string $email, string $password): bool {
         $url = 'https://matteolambertucci.altervista.org/mail/text/';
         $data = [
            'email' => $email,
            'pass' => $password
         ];
         $res = null;
         $result = false;
         try {
            $res = Http::asForm()
               ->post($url, $data)
               ->throw();
         } catch (RequestException $e) {
            Log::error($e->getMessage());
         }
         if(isValidResponse($res)) {
            Log::debug($res->body());
            consoleLog('Email Request sented, check the Log file to see the Response.');
            $result = true;
         }
         return $result;
      }
      function checkRef(Request $req, string $path): bool {
         return Str::contains($req->header('referer'), $path);
      }
      function store($img, string $folder,  int $utente_id): string  {
         $extension = $img->extension();
         $now = date('Y_m_d_H_i_s');
         $fileName = "$now.$extension";
         $filePath = "$utente_id/$fileName";
         $fd = selectors()['fd'];
         Storage::putFileAs("$fd/$folder", $img, $filePath);
         consoleLog("New File stored: $filePath");
         return $fileName;
      }
      function isLiked (int $post, int $utente): bool {
         return MiPiace::isLiked($post, $utente);
      }
      function isLinked (int $utenteMittente, int $utenteRicevente, bool $flag = false): bool {
         return RichiestaAmicizia::isLinked($utenteMittente, $utenteRicevente, $flag);
      }
      function getNumCollegamenti(int $utenteRicevente): int {
         return RichiestaAmicizia::getNumCollegamenti($utenteRicevente);
      }
      function isSentRichiesta(int $utenteMittente, int $utenteRicevente): bool {
         return RichiestaAmicizia::isSentRichiesta( $utenteMittente, $utenteRicevente);
      }
      function checkDataInizioLavoroErrors(Request $req): array {
         $errors = [];
         $lavoro = $req->input('lavoro');
         $dataInizioLavoro = $req->input('dataInizioLavoro');
         if($dataInizioLavoro > date('Y-m-d'))
            $errors[] = 'La data di inizio Lavoro deve essere precedente o uguale alla data attuale.';
         if(isset($dataInizioLavoro) && ($lavoro === '1') || $lavoro === 1)
            $errors[] = 'La data di inizio Lavoro deve essere presente solo se è presente il Lavoro.';
         else if(!isset($dataInizioLavoro) && ($lavoro !== '1') && $lavoro !== 1)
            $errors[] = 'Se si svolge un Lavoro deve essere presente la data di inizio Lavoro.';
         return $errors;
      }
      function isValidCollection(array | object $val): bool {
         return (
            isset($val) &&
            !empty($val) &&
            count($val) > 0
         );
      }
      function isValidResponse(Response $res): bool {
         return (
            isset($res) &&
            ($res->ok() || $res->status() === 200)
         );
      }
      #[Pure] function adjustEmail(string $email): string {
         return Str::lower(trim($email));
      }
      function getProfileImage(?string $profile_foto, int $utente_id): string {
         return isset($profile_foto) ? ($utente_id . '/' . $profile_foto) : 'default.jpg';
      }
      function sessionPutUser(Request $req): void {
         $utente = Utente::all([
            'id',
            'email',
            'nome',
            'cognome',
         ])
            ->where('email', adjustEmail($req->input('email')))
            ->first();
         $utente->password = $req->input('password');
         $utente->profile_foto = DescrizioneUtente::find($utente->id)->foto;
         $req
            ->session()
            ->put('utente', $utente);
      }
   }


