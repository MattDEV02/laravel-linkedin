<?php

namespace App\Http\Controllers;

use App\Models\Citta;
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

   public function logResult(Request $req): int | RedirectResponse{
      $logged = isLogged($req->email, $req->password);
      return $logged ? redirect('/feed') :
         redirect()
            ->route('registrazione', [
               'msg' => 'Utente non Registrato, provvedere farlo.'
            ]);
   }

   public function insert(Request $req): RedirectResponse {
      $email = $req->email;
      $password = $req->password;
      if(isLogged($email, $password))
         return redirect()
            ->route('login', [
               'msg' => 'Utente già Registrato, è possibile effettuare il Login.'
            ]);
      else {
         $utente = new Utente();
         $utente->email = $email; // Conferma Email
         $utente->password = $password;
         $utente->citta = $req->citta;
         $utente->save();
         return redirect()
            ->route('login', [
               'msg' => 'Utente Registrato, è possibile effettuare il Login.'
            ]);
      }
   }

   public function feed(): object {
      $posts = Post::all();
      return view('feed.index',['posts' => $posts]);
   }

   public function profile(Request $req): object {
      $utente_id = $utente->id;
      return view('profile.index',['utente_id' => $req->id]);
   }
}
