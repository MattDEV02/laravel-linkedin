<?php

namespace App\Http\Controllers;

use App\Models\Lavoro;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use App\Models\Citta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Utente;


class UtenteController extends Controller
{
   public function login(Request $req) {
      return view('login.index',[
         'msg' => $req->msg,
         'ref' => (checkRef($req, 'login') || checkRef($req, 'registrazione'))
      ]);
   }

   public function registrazione(Request $req): object {
      return view('registrazione.index',[
         'citta' => Citta::all(),
         'lavori' => Lavoro::all(),
         'msg' => $req->msg,
         'ref' => checkRef($req, 'login')
      ]);
   }

   public function insert(Request $req): RedirectResponse {
      $email = $req->email;
      if(isLogged($email))
         return redirect()
            ->route('login', ['msg' => 'log']);
      else {
         insertUtente($req);
         return redirect()
            ->route('login', ['msg' => 'reg']);
      }
   }

   public function logResult(Request $req){
      $email = $req->email;
      $password = $req->password;
      $logged = isLogged($email, $password);
      $utente = Utente::all([
         'id',
         'email',
         'password'
      ])
         ->where('email', $email)
         ->first();
      return $logged ?
         $this->feed($utente) :
         redirect()
            ->route('login', ['msg' => 'not-reg']);
   }

   public function feed(Utente $utente): Factory | View | Application
   {
      return view('feed.index',[
         'utente' => $utente,
         'posts' => getAllPosts()
      ]);
   }
}
