<?php

namespace App\Http\Controllers;

use App\Models\RichiestaAmicizia;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Citta;
use App\Models\Lavoro;
use App\Models\Utente;


class ProfileController extends Controller {

   private ?Utente $utente;

   public function profile(Request $req): Factory | View | Application {
      $this->utente = $req
         ->session()
         ->get('utente');
      $utente_id = $this->utente->id;
      $profile = getProfile($utente_id);
      return view('profile.index', [
         'profile' => $profile,
         'richieste' => getRichieste($utente_id),
         'posts' => getAllPosts($utente_id, true),
         'own_profile' => true
      ]);
   }

   public function editProfile(Request $req): Factory | View | Application | RedirectResponse {
      if(checkRef($req, 'profile') || checkRef($req, 'show-profile')) {
         $this->utente = $req
            ->session()
            ->get('utente');
         $profile = getProfile($this->utente->id);
         return view('profile.utils.form', [
            'lavori' => Lavoro::all(),
            'citta' => Citta::all(),
            'profile' => $profile
         ]);
      } else
         return redirect()
            ->route('logout');
   }
   public function updateProfile(Request $req): RedirectResponse {
      $req->validate([
         //'image' => ['image'],
         'nome' => ['required', 'min:2', 'max:45'],
         'cognome' => ['required', 'min:2', 'max:45'],
         'citta' => ['required'],
      ], [
         'nome.required' => 'Nome is Required.',
         'nome.min' => 'Nome almeno 3 caratteri.',
         'nome.max' => 'Nome massimo 45 caratteri.',
         'cognome.required' => 'Cognome is Required.',
         'cognome.min' => 'Cognome almeno 3 caratteri.',
         'cognome.max' => 'Cognome massimo 45 caratteri.',
         'citta.required'  => 'Citta is Required.',
      ]);
      updateProfile($req);
      return redirect('/profile');
   }
   public function showProfile(Request $req): Factory | View | Application {
      $emailSearched = $req->search;
      consoleLog("Profile searched: $emailSearched");
      $this->utente = $req
         ->session()
         ->get('utente');
      $utenteSearched = Utente::where(
         'email',  $emailSearched
      )->first();
      if(isset($utenteSearched)) {
         $utente_id = $this->utente->id;
         $utenteSearched_id = $utenteSearched->id;
         $profile = getProfile($utenteSearched_id);
         return view('profile.index', [
            'profile' => $profile,
            'richieste' => getRichieste($utente_id),
            'posts' => getAllPosts($utenteSearched_id, true),
            'own_profile' => $profile->utente_id === $utente_id,
         ]);
      } else {
         Log::error("User $emailSearched NOT FOUND.");
         return view('utils.user-not-found');
      }
   }
   public function collegamenti(Request $req): Factory | View | Application {
      $this->utente = $req
         ->session()
         ->get('utente');
      return view('collegamenti.index', [
         'collegamenti' => getCollegamenti( $this->utente->id)
      ]);
   }
   public function removeCollegamento(Request $req) {
      $this->utente = $req
         ->session()
         ->get('utente');
      $utente_id = $this->utente->id;
      $utenteCollegamento = Utente::where('email', $req->email)
         ->first();
      $idUtenteCollegamento = $utenteCollegamento->id;
      removeCollegamento($utente_id, $idUtenteCollegamento);
      return 'Collegamento deleted.';
   }
}
