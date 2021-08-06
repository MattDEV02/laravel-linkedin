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
         if(getLogLines() > 2500)
            Artisan::call('log:clear');
         $ip = $request->ip();
         $method = Str::upper($request->method());
         $url = urldecode($request->fullUrl());
         $format = $request->format();
         $reg = $request->hasCookie('password') ? 'yes' : 'no';
         $log = $request->session()->exists('utente') ? 'yes' : 'no';
         Log::notice("$ip -> $method -> ( $url ) -> accept: $format { reg: $reg, log: $log }.");
         return $next($request);
      }
   }
