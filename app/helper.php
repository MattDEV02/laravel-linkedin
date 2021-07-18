<?php

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Output\ConsoleOutput;
use App\Models\DescrizioneUtente;
use App\Models\RichiestaAmicizia;
use App\Models\Utente;
use App\Models\UtenteLavoro;


if(
   !function_exists('selectors') &&
   !function_exists('consoleLog') &&
   !function_exists('sendMail') &&
   !function_exists('handleError') &&
   !function_exists('checkRef') &&
   !function_exists('store') &&
   !function_exists('getAllPosts') &&
   !function_exists('insertUtente') &&
   !function_exists('getProfile') &&
   !function_exists('updateProfile') &&
   !function_exists('isLiked') &&
   !function_exists('isLinked') &&
   !function_exists('getNumCollegamenti') &&
   !function_exists('getNumRichiesteSospese') &&
   !function_exists('isSentRichiesta') &&
   !function_exists('getCollegamenti') &&
   !function_exists('removeCollegamento') &&
   !function_exists('checkDataInizioLavoroErrors') &&
   !function_exists('isValidCollection')
) {
   function selectors(): array {
      $imgFolder = 'img';
      $fd = 'public';
      return [
         'lang' =>  str_replace('_', '-', app()->getLocale()),
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
      $out = new ConsoleOutput();
      $s = strval($s);
      $out->writeln("<info>$s</info>");
      return $s;
   }

   function sendmail(string $email, string $password): bool
   {
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
         handleError($e->getMessage());
      }
      if($res->ok() || $res->status() === 200) {
         Log::debug($res->body());
         consoleLog('Email Request sented, check the Log file to see the Response.');
         $result = true;
      }
      return $result;
   }
   function handleError(string $msg): void
   {
      $ERROR_CODE = 500;
      Log::error($msg);
      abort($ERROR_CODE, $msg);
   }
   function checkRef(Request $req, string $path): bool {
      return str_contains($req->header('referer'), $path);
   }
   function isLogged(string $email, ?string $password = null): bool {
      $attr = ['email', 'password'];
      $utente = Utente::all($attr)
         ->where($attr[0], $email)
         ->first();
      $cond = isset($utente);
      return isset($password) ?
         $cond && (
            Hash::check($password, $utente->password) ||
            $password === $utente->password
         ) : $cond;
   }
   function store($img, string $folder,  int $utente_id): string  {
      $extension = $img->extension();
      $now = date('Y_m_d_H_i_s');
      $fileName = "$now.$extension";
      $filePath = "$utente_id/$fileName";
      $fd = selectors()['fd'];
      Storage::putFileAs("$fd/$folder", $img, $filePath);
      consoleLog("New File stored:  $filePath");
      return $fileName;
   }
   function getAllPosts(int $utente_id, bool $profile = false, $orderBy = 'p.created_at DESC'): array  // unica query scritta "pura", tutte le altre sono state definite tramite models e classe DB
   {
      $sql = ("
         SELECT 
            p.id,
            p.utente AS utente_id,
	         p.foto,
            p.testo,
            p.created_at,
            CONCAT(u.nome, ' ', u.cognome) AS utente,
            CONCAT(l.nome, ' presso ', c.nome, ', ', n.nome, '.') AS lavoroPresso,
            u.email AS utenteEmail,
            COUNT(mp.id) AS miPiace
        FROM 
	         Post p
            LEFT JOIN MiPiace mp ON p.id = mp.post
            JOIN Utente u ON p.utente = u.id
            JOIN UtenteLavoro ul ON ul.utente = u.id
            JOIN Lavoro l ON ul.lavoro = l.id
            JOIN Citta c ON u.citta = c.id
            JOIN Nazione n ON c.nazione = n.id
         WHERE
            True
        GROUP BY 
            p.id
        ORDER BY 
            $orderBy 
      ");
      if($profile)
         $sql = str_replace('True', "p.utente = $utente_id", $sql);
      return DB::select($sql);
   }
   function insertUtente(Request $req): string {
      $utente = new Utente();
      $utente->email = trim($req->input('email'));
      $password = $req->input('password');
      $utente->password = Hash::make($password);
      $utente->nome = ucfirst($req->input('nome'));
      $utente->cognome = ucfirst($req->input('cognome'));
      $utente->citta = $req->input('citta');
      $utente->save();
      $id = $utente->id;
      $utenteLavoro = new UtenteLavoro();
      $utenteLavoro->utente = $id;
      $utenteLavoro->lavoro = $req->input('lavoro');
      $utenteLavoro->dataInizioLavoro = $req->input('dataInizioLavoro');
      $utenteLavoro->save();
      $descrizioneUtente = new DescrizioneUtente();
      $descrizioneUtente->utente = $id;
      $descrizioneUtente->save();
      return $utente->email;
   }
   function getProfile(int $utente_id): ?object {
      return DB::table('Utente AS u')
         ->select([
            'du.id',
            'du.testo',
            'du.foto',
            'du.updated_at',
            'u.email AS utenteEmail',
            'u.nome AS utenteName',
            'u.cognome AS utenteSurname',
            'u.id AS utente_id',
            'ul.dataInizioLavoro',
            DB::raw("CONCAT(l.nome, ' presso ', c.nome, ', ', n.nome, '.') AS lavoroPresso")
         ])
         ->join('DescrizioneUtente AS du', 'du.utente', 'u.id')
         ->join('UtenteLavoro AS ul', 'ul.utente', 'u.id')
         ->join('Lavoro AS l', 'ul.lavoro', 'l.id')
         ->join('Citta AS c', 'u.citta', 'c.id')
         ->join('Nazione AS n', 'c.nazione', 'n.id' )
         ->where('u.id', $utente_id)
         ->first();
   }
   function updateProfile(Request $req): void {
      $id = $req
         ->session()
         ->get('utente')->id;
      $img = $req->input('image');
      $toUpdate = ['testo' => $req->input('testo')];
      if(isset($img)) {
         $dir = 'profiles';
         $files =  Storage::allFiles("public/$dir/$id/");
         Storage::delete($files);
         $toUpdate['foto'] = store($img , $dir, $id);
      }
      DescrizioneUtente::where(
         'utente', $id
      )->update($toUpdate);
      UtenteLavoro::where(
         'utente', $id
      )->update([
         'lavoro' => $req->input('lavoro'),
         'dataInizioLavoro' => $req->input('dataInizioLavoro')
      ]);
      $utente = Utente::find($id);
      $utente->nome = $req->input('nome');
      $utente->cognome = $req->input('cognome');
      $utente->citta = $req->input('citta');
      $utente->save();
      $req
         ->session()
         ->put('utente', $utente);
   }
   function getRichieste(int $utente_id): ?Collection {
      return DB::table('RichiestaAmicizia AS ra')
         ->select([
            'ra.utenteMittente AS utenteMittente',
            'ra.utenteRicevente AS utenteRicevente',
            DB::raw("DATE_FORMAT(ra.created_at, '%Y-%m-%d %H:%i') AS dataInvio"),
            'ra.stato',
            'u.email',
            DB::raw("CONCAT(u.nome, ' ', u.cognome) AS utenteNomeCognome")
         ])
         ->join('Utente AS u', 'ra.utenteMittente', 'u.id')
         ->where('ra.utenteRicevente', $utente_id)
         ->where('ra.stato', 'Sospesa')
         ->orderBy('dataInvio', 'DESC')
         ->get();
   }
   function isLiked (int $post, int $utente): int {
      $res = DB::table('MiPiace AS mp')
         ->select(DB::raw('COUNT(u.id) AS liked'))
         ->join('Post AS p', 'mp.post', 'p.id')
         ->join('Utente AS u', 'mp.utente', 'u.id')
         ->where('p.id', $post)
         ->where('u.id', $utente)
         ->first();
      return $res->liked;
   }
   function isLinked (int $utenteMittente, int $utenteRicevente, bool $flag = false): int {
      $stato = $flag ? 'Sospesa' : 'Accettata';
      $res = DB::table('RichiestaAmicizia AS ra')
         ->select(DB::raw('COUNT(ra.id) AS linked'))
         ->join('Utente AS u', 'ra.utenteMittente', 'u.id')
         ->join('Utente AS u2', 'ra.utenteRicevente', 'u2.id')
         ->where(function($query) use ($utenteMittente) {
            $query
               ->where('ra.utenteMittente', $utenteMittente)
               ->Orwhere('ra.utenteRicevente', $utenteMittente);
         })
         ->where(function($query) use ($utenteRicevente) {
            $query
               ->where('ra.utenteMittente', $utenteRicevente)
               ->Orwhere('ra.utenteRicevente', $utenteRicevente);
         })
         ->where('ra.stato', $stato)
         ->first();
      return $res->linked;
   }
   function getNumCollegamenti(int $utenteRicevente): int {
      return DB::table('RichiestaAmicizia AS ra')
         ->where('ra.stato', 'Accettata')
         ->where(function($query) use ($utenteRicevente) {
            $query
               ->where('ra.utenteRicevente', $utenteRicevente)
               ->Orwhere('ra.utenteMittente', $utenteRicevente);
         })
         ->count() ;
   }
   function getNumRichiesteSospese(int $utenteRicevente): int {
      return DB::table('RichiestaAmicizia AS ra')
         ->where('ra.stato', 'Sospesa')
         ->where('ra.utenteRicevente', $utenteRicevente)
         ->count() ;
   }
   function isSentRichiesta(int $utenteMittente, int $utenteRicevente): int {
      return DB::table('RichiestaAmicizia AS ra')
         ->join('Utente AS u', 'ra.utenteMittente', 'u.id')
         ->join('Utente AS u2', 'ra.utenteRicevente', 'u2.id')
         ->where('ra.utenteMittente', $utenteMittente)
         ->where('ra.utenteRicevente', $utenteRicevente)
         ->count();

   }
   function getCollegamenti(int $utente_id): Collection
   {
      return DB::table('Utente AS u')
         ->select([
            DB::raw('CONCAT(u.nome, " ", u.cognome) AS utenteNomeCognome'),
            'u.email AS utenteEmail',
            DB::raw('DATE_FORMAT(ra.created_at, "%Y-%m-%d %H:%i") AS dataInvioRichiesta')
         ])
         ->join('RichiestaAmicizia AS ra', function ($join) {
            $join
               ->on('u.id', 'ra.utenteMittente')
               ->orOn('u.id', 'ra.utenteRicevente');
         })
         ->join('Utente AS u2', 'u2.id', 'ra.utenteRicevente')
         ->where(function($query) use ($utente_id) {
            $query
               ->where('ra.utenteRicevente', $utente_id)
               ->Orwhere('ra.utenteMittente', $utente_id);
         })
         ->where('u.id', '<>', $utente_id)
         ->where('ra.stato', 'Accettata')
         ->get();
   }
   function removeCollegamento($utente, $collegamento) {
      RichiestaAmicizia::where(function($query) use ($utente) {
         $query
            ->where('utenteMittente', $utente)
            ->Orwhere('utenteRicevente', $utente);
      })
         ->where(function($query) use ($collegamento) {
            $query
               ->where('utenteMittente', $collegamento)
               ->Orwhere('utenteRicevente', $collegamento);
         })
         ->where('stato', 'accettata')
         ->delete();
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
}


