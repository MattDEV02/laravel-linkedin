<?php

use App\Models\Utente;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


if(
   !function_exists('selectors') and
   !function_exists('consoleLog') and
   !function_exists('sendMail') and
   !function_exists('handleError') and
   !function_exists('isEloquentAttr')
) {
   function selectors(): array {
      return [
         'lang' =>  str_replace('_', '-', app()->getLocale()),
         'dir' => 'ltr',
         'charset' => 'UTF-8',
         'author' => 'Matteo Lambertucci <matteolambertucci3@gmail.com>',
         'container' => 'container-fluid',
         'col' => 'col-12 mt-',
         'row' => 'row justify-content-center',
         'fw' => 'font-weight-bold',
         'input' => 'form-control form-control-lg border border-dark inputTXT',
         'btn' => 'btn btn-lg',
         'email' => 'email',
         'pass' => 'password',
         'date' => 'dataInizioLavoro',
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
   function isLogged(string $email, string $password): int {
      return Utente::where('email', $email)
         ->where('password', $password)
         ->count() ;
   }
}


