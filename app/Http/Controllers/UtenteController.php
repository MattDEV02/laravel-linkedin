<?php

namespace App\Http\Controllers;

use App\Models\DescrizioneUtente;
use App\Models\Lavoro;
use App\Models\UtenteLavoro;
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
         'ref' => checkRef($req, 'login') || checkRef($req, 'registrazione')
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
         insertUtente($email, $req);
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

   public function profile(Request $req) {
      $id = $req->utente_id;
      $utente = Utente::find($id);
      $profile = getProfile($id);
      return view('profile.index', [
         'profile' => $profile[0],
         'utente' => $utente,
         'posts' => getAllPosts($id)
      ]);
   }

   public function editProfile(Request $req) {
      $id = $req->utente_id;
      $profile = getProfile($id);
      $utente = Utente::find($id);
      return view('profile.utils.form', [
         'utente' => $utente,
         'lavori' => Lavoro::all(),
         'citta' => Citta::all(),
         'profile' => $profile[0]
      ]);
   }
   public function updateProfile(Request $req) {
      $utente_id = updateProfile($req);
      return  redirect()
         ->route('profile', ['utente_id' => $utente_id]);
   }
   public function showProfile(Request $req) {
      $utente = Utente::find($req->utente_id);
      $utenteSearched = Utente::where(
         'email', $req->search
      )->get();
      $id = $utenteSearched[0]->id;
      $profile = getProfile($id);
      return view('profile.index', [
         'profile' => $profile[0],
         'posts' => getAllPosts($id),
         'showProfile' => true,
         'utente' => $utente
      ]);
   }
}
