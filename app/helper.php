<?php

use App\Models\Utente;
use Illuminate\Http\Client\RequestException;
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
   !function_exists('getAllPosts')
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
         'title' => 'Clicca per Mostrare / Nascondere la Password'
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
   function getAllPosts()  {
      return Utente::select(
         'Post.*',
         'Utente.email AS utenteMail'
      )
         ->orderByPowerJoins('Post.created_at', 'DESC')
         ->get();
   }
}


