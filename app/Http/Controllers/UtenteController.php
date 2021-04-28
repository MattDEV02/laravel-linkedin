<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UtenteController extends Controller
{
   public function index(): object {
      return view('login');
   }

   public function login(Request $req) {

   }
   public function registrazione(Request $req) {

   }
}
