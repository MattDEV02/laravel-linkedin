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


class UtenteController extends Controller {

   //private Utente $utente;

   public function login(Request $req) {
      return view('login.index',[
         'msg' => $req->msg,
         'ref' => (checkRef($req, 'login') || checkRef($req, 'registrazione'))
      ]);
   }

   public function logout(Request $req) {
      $req
         ->session()
         ->forget('utente');
      return redirect()
         ->route('login');
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
      if($logged) {
         $utente = Utente::all([
            'id',
            'email',
            'password',
            'nome',
            'cognome',
         ])
            ->where('email', $email)
            ->first();
         $req
            ->session()
            ->put('utente', $utente);
         return $this->feed();
      } else
         return redirect()
            ->route('login', ['msg' => 'not-reg']);
   }

   public function feed(): Factory | View | Application
   {
      return view('feed.index', [
         'posts' => getAllPosts()
      ]);
   }
}
