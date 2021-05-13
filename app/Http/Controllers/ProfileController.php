<?php

namespace App\Http\Controllers;

use App\Models\Citta;
use App\Models\Lavoro;
use App\Models\Utente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

   public function profile(Request $req) {
      $id = $req->utente_id;
      $utente = Utente::find($id);
      $profile = getProfile($id);
      return view('profile.index', [
         'profile' => $profile,
         'utente' => $utente,
         'posts' => getAllPosts($id),
         'own' => $profile->utente_id === $utente->id,
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
         'profile' => $profile
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
         'profile' => $profile,
         'posts' => getAllPosts($id),
         'own' => $profile->utente_id === $utente->id,
         'utente' => $utente
      ]);
   }
}
