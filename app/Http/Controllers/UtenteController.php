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
      return $logged ?
         $this->feed($utente->id) :
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
         $utente->nome = ucfirst($req->nome);
         $utente->cognome = ucfirst($req->cognome);
         $utente->citta = $req->citta;
         $utente->save();
         $utenteLavoro = new UtenteLavoro();
         $utenteLavoro->utente = $utente->id;
         $utenteLavoro->save();
         $descrizioneUtente = new DescrizioneUtente();
         $descrizioneUtente->utente = $utente->id;
         $descrizioneUtente->save();
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
      $profile = DB::table('Utente AS u')
         ->select([
            'du.testo',
            'du.foto',
            'du.updated_at',
            'u.email AS utenteMail',
            'u.nome AS utenteName',
            'u.cognome AS utenteSurname',
            'u.id AS utente_id',
            'l.nome AS lavoro',
            'c.nome AS citta',
            'n.nome AS nazione'
         ])
         ->join('DescrizioneUtente AS du', 'du.utente', 'u.id')
         ->join('UtenteLavoro AS ul', 'ul.utente', 'u.id')
         ->join('Lavoro AS l', 'ul.lavoro', 'l.id')
         ->join('Citta AS c', 'u.citta', 'c.id')
         ->join('Nazione AS n', 'c.nazione', 'n.id' )
         ->where('u.id', $req->utente_id)
         ->get();
      return view('profile.index', [
         'profile' => $profile[0]
      ]);
   }

   public function editProfile(Request $req) {
      $lavori = Lavoro::all()
         ->sortBy('id');
      return view('profile.utils.form', [
         'utente_id' => $req->utente_id,
         'lavori' => $lavori
      ]);
   }
   public function updateProfile(Request $req) {
      return $req->all();
   }
}
