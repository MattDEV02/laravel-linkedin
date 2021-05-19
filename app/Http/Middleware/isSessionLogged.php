<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class isSessionLogged
{
   /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
   public function handle(Request $request, Closure $next): mixed {
      return $request
         ->session()
         ->exists('utente') ?
         $next($request) :
         redirect()
            ->route('logout');
   }
}