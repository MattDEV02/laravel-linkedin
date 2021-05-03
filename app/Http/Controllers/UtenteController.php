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
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


class UtenteController extends Controller
{
   public function login(Request $req): View {
      return view('login.index',[
         'msg' => $req->msg
      ]);
   }

   public function registrazione(Request $req): View {
      return view('registrazione.index',[
         'citta' => Citta::all(),
         'msg' => $req->msg
      ]);
   }

   public function logResult(Request $req): View | RedirectResponse {
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

   public function feed(int $id) {
      $posts = Post::all(); // JOIN
      return view('feed.index', [
         'posts' => $posts,
         'utente_id' => $id
      ]);
   }

   public function profile(Request $req): View {
      $utente_id = $req->utente_id;
      // DescrizioneUtente  JOIN E FIND BY ID
      return view('profile.index',[
         'utente_id' => $utente_id
      ]);
   }
}
