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
      $req
         ->session()
         ->put('profile_utente_id', $profile->id);
      return view('profile.index', [
         'profile' => $profile,
         'richieste' => getRichieste($utente_id),
         'posts' => getAllPosts($utente_id, true),
         'own_profile' => true
      ]);
   }

   public function editProfile(Request $req): Factory | View | Application | RedirectResponse {
      if(checkRef($req, 'profile') || checkRef($req, 'show-profile') || checkRef($req, 'edit-profile')) {
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
            ->route('/profile');
   }
   public function updateProfile(Request $req): RedirectResponse {
      $req->validate([
         //'image' => ['image'],
         'nome' => ['required', 'min:2', 'max:45'],
         'cognome' => ['required', 'min:2', 'max:45'],
         'citta' => ['required', 'numeric', 'min:1', 'max:13'],
         'lavoro' => ['required', 'numeric', 'min:1', 'max:15'],
         'dataInizioLavoro' => ['nullable', 'date', 'date_format:Y-m-d'],
         'testo' => ['nullable', 'max:255']
      ], [
         'nome.required' => 'Nome is Required.',
         'nome.min' => 'Nome almeno 2 caratteri.',
         'nome.max' => 'Nome massimo 45 caratteri.',
         'cognome.required' => 'Cognome is Required.',
         'cognome.min' => 'Cognome almeno 2 caratteri.',
         'cognome.max' => 'Cognome massimo 45 caratteri.',
         'citta.required' => 'Città is Required.',
         'citta.numeric' => 'Città inserita non valida.',
         'citta.min' => 'Città inserita non valida.',
         'citta.max' => 'Città inserita non valida.',
         'lavoro.required' => 'Lavoro is Required.',
         'lavoro.numeric' => 'Lavoro inserito non valido.',
         'lavoro.min' => 'Lavoro inserito non valido.',
         'lavoro.max' => 'Lavoro inserito non valido.',
         'dataInizioLavoro.date' => 'Data inizio lavoro is a date.',
         'dataInizioLavoro.date_format' => 'Incorrect date format for Data inizio lavoro.',
         'testo.max' => 'Testo della descrizione troppo lungo.'
      ]);
      $errors = checkDataInizioLavoroErrors($req);
      if(isValidCollection($errors))
         return back()
            ->withErrors($errors);
      else {
         updateProfile($req);
         return redirect('/profile')
            ->with('msg', 'Profile updated successful.');
      }
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
         $req
            ->session()
            ->put('profile_utente_id', $profile->utente_id);
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
      $utente_id = $req
            ->session()
            ->get('profile_utente_id') ?? $this->utente->id;
      return view('collegamenti.index', [
         'collegamenti' => getCollegamenti($utente_id)
      ]);
   }

   public function removeCollegamento(Request $req) {
      if(checkRef($req, 'collegamenti')) {
         $this->utente = $req
            ->session()
            ->get('utente');
         $utente_id = $this->utente->id;
         $utenteCollegamento = Utente::where('email', $req->email)
            ->first();
         $idUtenteCollegamento = $utenteCollegamento->id;
         removeCollegamento($utente_id, $idUtenteCollegamento);
         return 'Collegamento deleted.';
      } else
         redirect('/profile');
   }
}
