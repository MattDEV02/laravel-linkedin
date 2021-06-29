<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use App\Models\Utente;
use App\Models\Citta;
use App\Models\Lavoro;


class UtenteController extends Controller {

   public function login(Request $req): Factory | View | Application {
      $req->validate([
         'msg' => ['min:3', 'max:75'],
      ], [
         'msg.min' => 'Invalid MSG.',
         'msg.max' => 'Invalid MSG.'
      ]);
      return view('login.index',[
         'msg' => $req->msg
      ]);
   }

   public function logout(Request $req): RedirectResponse {
      $req
         ->session()
         ->forget('utente');
      Cookie::queue(Cookie::forget('password'));
      Log::warning('Finished User-Session.');
      return redirect()
         ->route('login');
   }

   public function registrazione(Request $req): Factory | View | Application {
      $req->validate([
         'msg' => ['min:3', 'max:75'],
      ], [
         'msg.min' => 'Invalid MSG.',
         'msg.max' => 'Invalid MSG.'
      ]);
      return view('registrazione.index',[
         'citta' => Citta::all(),
         'lavori' => Lavoro::all(),
         'msg' => $req->msg
      ]);
   }

   public function insert(Request $req): RedirectResponse {
      $req->validate([
         'email' => ['email', 'required', 'unique:Utente','min:2', 'max:35'],
         'password' => ['required', 'min:8', 'max:8'],
         'nome' => ['required', 'min:3', 'max:45'],
         'cognome' => ['required', 'min:3', 'max:45'],
         'citta' => ['required'],
      ], [
         'email.required' => 'Email is Required.',
         'email.min' => 'Email almeno 2 caratteri.',
         'email.max' => 'Email massimo 35 caratteri.',
         'email.unique' => 'Utente già Registrato, è possible effettuare il Login.',
         'password.required'  => 'Password is Required.',
         'password.min'  => 'Password con 8 caratteri.',
         'password.max'  => 'Password con 8 caratteri.',
         'nome.required' => 'Nome is Required.',
         'nome.min' => 'Nome almeno 3 caratteri.',
         'nome.max' => 'Nome massimo 45 caratteri.',
         'cognome.required' => 'Cognome is Required.',
         'cognome.min' => 'Cognome almeno 3 caratteri.',
         'cognome.max' => 'Cognome massimo 45 caratteri.',
         'citta.required'  => 'Città is Required.',
      ]);
      insertUtente($req);
      Log::debug('New User Interted.');
      return redirect('/login')
         ->with('msg', 'reg');
   }

   public function logResult(Request $req): Factory | View | RedirectResponse | Application {
      $req->validate([
         'email' => ['email', 'required', 'min:2', 'max:35'],
         'password' => ['required', 'min:8', 'max:8'],
      ], [
         'email.email' => 'Inserisci Email valida',
         'email.required' => 'Email is Required.',
         'email.min' => 'Email almeno 2 caratteri.',
         'email.max' => 'Email massimo 35 caratteri.',
         'password.required' => 'Password is Required.',
         'password.min'  => 'Password con 8 caratteri.',
         'password.max'  => 'Password con 8 caratteri.',
      ]);
      $email = $req->email;
      $password = $req->password;
      $logged = isLogged($email, $password);
      if($logged) {
         if(!$req->navbar) {
            $utente = Utente::all([
               'id',
               'email',
               'password',
               'nome',
               'cognome',
            ])
               ->where('email', $email)
               ->first();
            $utente->password = $password;
            $req
               ->session()
               ->put('utente', $utente);
            Log::info("New User-Session started ($email)");
         }
         $utente_id = $req->session()
            ->get('utente')->id;
         return view('feed.index', [
            'posts' => getAllPosts($utente_id),
            'profile_id' => null
         ]);
      } else
         return back()
            ->withErrors([
               'error' => 'Utente non registrato, è possible farlo.'
            ]);
   }

   public function passwordDimenticata(Request $req): bool {
      $req->validate([
         'email' => ['email', 'required', 'min:2', 'max:35'],
         'password' => ['required', 'min:8', 'max:8'],
      ], [
         'email.email' => 'Inserisci Email valida',
         'email.required' => 'Email is Required.',
         'email.min' => 'Email almeno 2 caratteri.',
         'email.max' => 'Email massimo 35 caratteri.',
         'password.required'  => 'Password is Required.',
         'password.min'  => 'Password con 8 caratteri.',
      ]);
      $email = $req->email;
      $password = $req->password;
      $res = false;
      $utente = Utente::where('email', $email);
      if($utente->count()) {
         $utente->update(['password' => Hash::make($password)]);
         Cookie::queue('password', $password, (60 * 24));
         $res = sendmail($email, $password);
      }
      return $res;
   }
}
