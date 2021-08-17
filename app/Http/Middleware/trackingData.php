<?php

   namespace App\Http\Middleware;

   use Closure;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Artisan;
   use Illuminate\Support\Facades\Log;
   use Illuminate\Support\Str;


   class trackingData {

      /**
       * Handle an incoming request.
       *
       * @param Request $request
       * @param Closure $next
       * @return mixed
       */
      public function handle(Request $request, Closure $next): mixed {
         if(getLogLines() > 1500)
            Artisan::call('log:clear');
         $ip = $request->ip();
         $userAgent = $request->header('User-Agent');
         $method = Str::upper($request->method());
         $url = urldecode($request->fullUrl());
         $ref = $request->header('referer') ?? 'null';
         $format = $request->format();
         $langHeader = $request->header('accept-language');
         $lang = Str::substr($langHeader, 0, strpos($langHeader, ','));
         $connection = $request->header('connection');
         $reg = $request->hasCookie('password') ? 'yes' : 'no';
         $log = $request->session()->exists('utente') ? 'yes' : 'no';
         Log::notice("( $ip, $userAgent ) -> $method -> [ URL = $url, referer = $ref ] -> format: $format ; lang: $lang ; connection: $connection  { registered: $reg, logged: $log }");
         return $next($request);
      }
   }
