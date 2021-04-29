<?php

namespace App\Http\Controllers;

use App\Models\Lavoro;
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
      return view('registrazione', ['lavori' => $lavori]);
   }
   public function insert(Request $req): array {
      return $req->all();
   }
}
