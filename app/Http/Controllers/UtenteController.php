<?php

namespace App\Http\Controllers;

use App\Models\Citta;
use App\Models\DescrizioneUtente;
use App\Models\Lavoro;
use App\Models\Post;
use App\Models\UtenteLavoro;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Utente;


class UtenteController extends Controller
{
   public function login(Request $req): object {
      return view('login.index',[
         'msg' => $req->msg
      ]);
   }

   public function registrazione(Request $req): object {
      return view('registrazione.index',[
         'citta' => Citta::all(),
         'msg' => $req->msg
      ]);
   }

   public function logResult(Request $req): int | RedirectResponse {
      $email = $req->email;
      $logged = isLogged($email);
      $utente = Utente::all(['id', 'email'])
         ->where('email', $email)
         ->first();
      return $logged ? redirect("/feed/".$utente->id) :
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

   public function feed(Request $req) {
      $posts = Post::all();
      $req->headers->set('utente_id', '2');
      return $req->headers->get('utente_id');
      //return view('feed.index',['posts' => $posts, 'utente_id' => $req->utente_id ]);
   }

   public function profile(Request $req): object {
      $utente_id = $req->utente_id;
      // DescrizioneUtente  JOIN E FIND BY ID
      return view('profile.index',['utente_id' => $utente_id]);
   }
}
