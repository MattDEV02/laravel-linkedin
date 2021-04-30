<?php

namespace App\Http\Controllers;

use App\Models\Citta;
use App\Models\Lavoro;
use App\Models\UtenteLavoro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Utente;


class UtenteController extends Controller
{
   public function index(): object {
      return view('login');
   }

   public function login(Request $req): mixed {
      $logged = isLogged($req->email, $req->password);
      return $logged ? redirect('/') : 'no Loggato'; //
   }
   public function registrazione() :object {
      $lavori = Lavoro::all()
         ->sortBy('id');
      $citta = Citta::all();
      return view('registrazione', [
         'lavori' => $lavori,
         'citta' => $citta
      ]);
   }
   public function insert(Request $req) {
      $email = $req->email;
      $password = $req->password;
      if(isLogged($email, $password))
         return redirect('/');
      else {
         $utente = new Utente();
         $utente->email = $email;
         $utente->password = $password;
         $utente->dataInizioLavoro = $req->dataInizioLavoro;
         $utente->citta = $req->citta;
         $utente->save();
         $utenteLavoro = new UtenteLavoro();
         $utenteLavoro->lavoro = $req->lavoro;
         $utenteLavoro->utente = $utente->id;
         $utenteLavoro->save();
         return 'OK';
      }
   }
}
