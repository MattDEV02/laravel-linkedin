<?php

namespace App\Http\Controllers;

use App\Models\DescrizioneUtente;
use App\Models\Lavoro;
use App\Models\UtenteLavoro;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use App\Models\Citta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Utente;
use Illuminate\Support\Facades\DB;


class UtenteController extends Controller
{
   public function login(Request $req) {
      return view('login.index',[
         'msg' => $req->msg,
         'ref' => checkRef($req, 'registrazione')
      ]);
   }

   public function registrazione(Request $req): object {
      return view('registrazione.index',[
         'citta' => Citta::all(),
         'msg' => $req->msg,
         'ref' => checkRef($req, 'login')
      ]);
   }

   public function logResult(Request $req){
      $email = $req->email;
      $password = $req->password;
      $logged = isLogged($email, $password);
      $utente = Utente::all(['id', 'email'])
         ->where('email', $email)
         ->first();
      return $logged && checkRef($req, 'login') ?
         $this->feed($utente->id) :
         redirect()
            ->route('registrazione', ['msg' => 'not-reg']);
   }

   public function insert(Request $req): RedirectResponse {
      $email = $req->email;
      if(isLogged($email))
         return redirect()
            ->route('login', ['msg' => 'log']);
      else {
         insertUtente($email, $req->password, $req->nome, $req->cognome, $req->citta);
         return redirect()
            ->route('login', ['msg' => 'reg']);
      }
   }

   public function feed(int $utente_id): Factory | View | Application
   {
      return view('feed.index',[
         'utente_id' => $utente_id,
         'posts' => getAllPosts()
      ]);
   }

   public function profile(Request $req) {
      $id = $req->utente_id;
      $profile = getProfile($id);
      return view('profile.index', [
         'profile' => $profile[0],
         'utente_id' => $profile[0]->utente_id,
         'posts' => getAllPosts($id)
      ]);
   }

   public function editProfile(Request $req) {
      $lavori = Lavoro::all()
         ->sortBy('id');
      $profile = getProfile($req->utente_id);
      return view('profile.utils.form', [
         'utente_id' => $req->utente_id,
         'lavori' => $lavori,
         'profile' => $profile[0]
      ]);
   }
   public function updateProfile(Request $req) {
      $id = $req->utente_id;
      $descrizioneUtente = DescrizioneUtente::where(
         'utente', $id
      )->update([
            'testo' => $req->testo,
            'foto' => $req->image
         ]
      );
      $utenteLavoro = UtenteLavoro::where(
         'utente', $id
      )->update([
         'lavoro' => $req->lavoro,
         'dataInizioLavoro' => $req->dataInizioLavoro
      ]);
      return redirect("/profile?utente_id=$id");
   }
   public function showProfile(Request $req) {
      $utente = Utente::where(
         'email', $req->search
      )->get();
      $id = $utente[0]->id;
      $profile = getProfile($id);
      return view('profile.index', [
         'profile' => $profile[0],
         'posts' => getAllPosts($id),
         'showProfile' => true
      ]);
   }
}
