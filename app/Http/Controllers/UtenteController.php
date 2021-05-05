<?php

namespace App\Http\Controllers;

use App\Models\Citta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Utente;


class UtenteController extends Controller
{
   public function login(Request $req) {
      return view('login.index',[
         'msg' => $req->msg
      ]);
   }

   public function registrazione(Request $req) {
      return view('registrazione.index',[
         'citta' => Citta::all(),
         'msg' => $req->msg
      ]);
   }

   public function logResult(Request $req){
      $email = $req->email;
      $logged = isLogged($email);
      $utente = Utente::all(['id', 'email'])
         ->where('email', $email)
         ->first();
      return $logged ? $this->feed($utente->id) :
         redirect()
            ->route('registrazione', ['msg' => 'not-reg']);
   }

   public function insert(Request $req): RedirectResponse {
      $email = $req->email;
      $password = $req->password;
      if(isLogged($email))
         return redirect()
            ->route('login', ['msg' => 'log']);
      else {
         $utente = new Utente();
         $utente->email = $email; // Conferma Email
         $utente->password = $password;
         $utente->citta = $req->citta;
         $utente->save();
         return redirect()
            ->route('login', ['msg' => 'reg']);
      }
   }

   public function feed(int $utente_id) {
      return view('feed.index');
   }

   public function profile(Request $req) {
      $utente_id = $req->utente_id;
      // DescrizioneUtente  JOIN E FIND BY ID
      return view('profile.index',[
         'utente_id' => $utente_id
      ]);
   }
}
