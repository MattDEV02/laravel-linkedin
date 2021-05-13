<?php

use App\Models\DescrizioneUtente;
use App\Models\Utente;
use App\Models\UtenteLavoro;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Output\ConsoleOutput;


if(
   !function_exists('selectors') and
   !function_exists('consoleLog') and
   !function_exists('sendMail') and
   !function_exists('handleError') and
   !function_exists('isEloquentAttr') and
   !function_exists('postRedirect') and
   !function_exists('store') and
   !function_exists('getAllPosts') and
   !function_exists('checkRef') and
   !function_exists('insertUtente') and
   !function_exists('getProfile') and
   !function_exists('updateProfile')
) {
   function selectors(): array {
      $imgFolder = 'img';
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
         'fd' => 'public'
      ];
   }
   function consoleLog($s): void
   {
      $out = new ConsoleOutput();
      $s = strval($s);
      $out->writeln("<info>$s</info>");
   }

   function sendEmail(string $text): void
   {
      $url = 'https://matteolambertucci.altervista.org/mail/text/'; //
      $data = ['text' => $text];
      $res = null;
      try {
         $res = Http::asForm()
            ->post($url, $data)
            ->throw();
      } catch (RequestException $e) {
         handleError($e->getMessage());
      }
      $body = $res->body();
      $body !== 'Email not sented' ?
         Log::debug("[ $url ] Response OK ; $body.") :
         Log::warning("[ $url ] Bad Response ; $body.");
      consoleLog("Check the Log file to see the Response.");
   }
   function handleError(string $msg): void
   {
      $ERROR_CODE = 500;
      Log::error($msg);
      abort($ERROR_CODE, $msg);
   }
   function isEloquentAttr(string $attr): bool
   {
      return (
         $attr === 'id' ||
         $attr === 'created_at' ||
         $attr === 'updated_at'
      );
   }
   function isLogged(string $email, ?string $password = null): int {
      $attr = ['email', 'password'];
      $res = $password ?
         Utente::where($attr[0], $email)
            ->where($attr[1], $password) :
         Utente::where($attr[0], $email);
      return $res->count();
   }
   function store($img, string $folder,  int $utente_id): string  {
      $extension = $img->extension();
      $now = date('Y_m_d_H_i_s');
      $fileName = "$now.$extension";
      $filePath = "$utente_id/$fileName";
      Storage::putFileAs("public/$folder", $img, $filePath);
      return $fileName;
   }
   function getAllPosts(?int $utente_id = null)
   {
      $sql = ("
         SELECT 
            p.utente AS utente_id,
	         p.foto,
            p.testo,
            p.created_at,
            CONCAT(u.nome, ' ', u.cognome) AS utente,
            CONCAT(l.nome, ' presso ', c.nome, ', ', n.nome, '.') AS lavoroPresso,
            COUNT(mp.id) AS miPiace
        FROM 
	         Post p
            LEFT JOIN MiPiace mp ON p.id = mp.post
            JOIN Utente u ON p.utente = u.id
            JOIN UtenteLavoro ul ON ul.utente = u.id
            JOIN Lavoro l ON ul.lavoro = l.id
            JOIN Citta c ON u.citta = c.id
            JOIN Nazione n ON c.nazione = n.id
         Where
            True
        GROUP BY 
            p.foto,
            p.created_at,
            p.testo,
            p.utente,
            utente,
            lavoroPresso
        ORDER BY 
            p.created_at
      ");
      if(isset($utente_id))
         $sql = str_replace("True", "p.utente = $utente_id", $sql);
      return DB::select($sql);
   }
   function checkRef(Request $req, string $path): bool {
      return str_contains($req->header('referer'), $path);
   }
   function insertUtente(string $email, Request $req): void {
      $utente = new Utente();
      $utente->email = $req->email; // Conferma Email
      $utente->password = $req->password;
      $utente->nome = ucfirst($req->nome);
      $utente->cognome = ucfirst($req->cognome);
      $utente->citta = $req->citta;
      $utente->save();
      $utenteLavoro = new UtenteLavoro();
      $utenteLavoro->utente = $utente->id;
      $utenteLavoro->lavoro = $req->lavoro;
      $utenteLavoro->dataInizioLavoro = $req->dataInizioLavoro;
      $utenteLavoro->save();
      $descrizioneUtente = new DescrizioneUtente();
      $descrizioneUtente->utente = $utente->id;
      $descrizioneUtente->save();
   }
   function getProfile(int $utente_id): ?object {
      return DB::table('Utente AS u')
         ->select([
            'du.testo',
            'du.foto',
            'du.updated_at',
            'u.email AS utenteMail',
            'u.nome AS utenteName',
            'u.cognome AS utenteSurname',
            'u.id AS utente_id',
            'l.nome AS lavoro',
            'ul.dataInizioLavoro',
            'c.nome AS citta',
            'n.nome AS nazione'
         ])
         ->join('DescrizioneUtente AS du', 'du.utente', 'u.id')
         ->join('UtenteLavoro AS ul', 'ul.utente', 'u.id')
         ->join('Lavoro AS l', 'ul.lavoro', 'l.id')
         ->join('Citta AS c', 'u.citta', 'c.id')
         ->join('Nazione AS n', 'c.nazione', 'n.id' )
         ->where('u.id', $utente_id)
         ->first();
   }
   function updateProfile(Request $req): int {
      $id = $req->utente_id;
      $img = $req->image;
      $toUpdate = [
         'testo' => $req->testo
      ];
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
         'lavoro' => $req->lavoro,
         'dataInizioLavoro' => $req->dataInizioLavoro
      ]);
      $utente = Utente::find($id);
      $utente->nome = $req->nome;
      $utente->cognome = $req->cognome;
      $utente->citta = $req->citta;
      $utente->save();
      return $id;
   }
}


