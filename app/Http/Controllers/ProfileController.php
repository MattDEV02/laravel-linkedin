<?php

namespace App\Http\Controllers;

use App\Models\DescrizioneUtente;
use App\Models\Post;
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
      $profile = DescrizioneUtente::getProfile($utente_id);
      $req
         ->session()
         ->put('profile_utente_id', $profile->id);
      return view('profile.index', [
         'profile' => $profile,
         'richieste' => RichiestaAmicizia::getRichieste($utente_id),
         'posts' => Post::getAll($utente_id, true),
         'own_profile' => true
      ]);
   }

   public function editProfile(Request $req): Factory | View | Application | RedirectResponse {
      if(checkRef($req, 'profile') || checkRef($req, 'show-profile') || checkRef($req, 'edit-profile')) {
         $this->utente = $req
            ->session()
            ->get('utente');
         $profile = DescrizioneUtente::getProfile($this->utente->id);
         return view('profile.utils.form', [
            'lavori' => Lavoro::all(),
            'citta' => Citta::all(),
            'profile' => $profile
         ]);
      } else
         return redirect('/profile');
   }
   public function updateProfile(Request $req): RedirectResponse {
      $req->validate([
         'image' => ['nullable', 'max:2000', 'mimes:jpeg,png,doc,docs,pdf,ico,svg,bmp,web'],
         'nome' => ['required', 'min:2', 'max:45'],
         'cognome' => ['required', 'min:2', 'max:45'],
         'citta' => ['required', 'numeric', 'min:1', 'max:13'],
         'lavoro' => ['required', 'numeric', 'min:1', 'max:15'],
         'dataInizioLavoro' => ['nullable', 'date', 'date_format:Y-m-d'],
         'testo' => ['nullable', 'max:255']
      ], [
         'image.mimes' => 'Insert a valid image.',
         'image.max' => 'Immagine troppo pesante.',
         'required' => ':attribute is Required.',
         'nome.min' => 'Nome almeno 2 caratteri.',
         'nome.max' => 'Nome massimo 45 caratteri.',
         'cognome.min' => 'Cognome almeno 2 caratteri.',
         'cognome.max' => 'Cognome massimo 45 caratteri.',
         'citta.numeric' => 'Città inserita non valida.',
         'citta.min' => 'Città inserita non valida.',
         'citta.max' => 'Città inserita non valida.',
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
         $utenteProfileUpdated = DescrizioneUtente::updateProfile($req);
         Log::debug("User $utenteProfileUpdated updated his profile.");
         return redirect('/profile')
            ->with('msg', 'Profile updated successful.');
      }
   }
   public function showProfile(Request $req): Factory | View | Application {
      $emailSearched = $req->input('search');
      consoleLog("Profile searched: $emailSearched");
      $this->utente = $req
         ->session()
         ->get('utente');
      $utenteSearched = Utente::where('email',  $emailSearched)
         ->first();
      if(isset($utenteSearched)) {
         $utente_id = $this->utente->id;
         $utenteSearched_id = $utenteSearched->id;
         $profile = DescrizioneUtente::getProfile($utenteSearched_id);
         $req
            ->session()
            ->put('profile_utente_id', $profile->utente_id);
         return view('profile.index', [
            'profile' => $profile,
            'richieste' => RichiestaAmicizia::getRichieste($utente_id),
            'posts' => Post::getAll($utenteSearched_id, true),
            'own_profile' => $profile->utente_id === $utente_id,
         ]);
      } else {
         Log::error("User ($emailSearched) NOT FOUND.");
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
         'collegamenti' => RichiestaAmicizia::getCollegamenti($utente_id)
      ]);
   }

   public function removeCollegamento(Request $req) {
      if(checkRef($req, 'collegamenti')) {
         $this->utente = $req
            ->session()
            ->get('utente');
         $utente_id = $this->utente->id;
         $utenteCollegamento = Utente::where(
            'email', $req->input('email')
         )->first();
         $idUtenteCollegamento = $utenteCollegamento->id;
         RichiestaAmicizia::removeCollegamento($utente_id, $idUtenteCollegamento);
         return 'Collegamento deleted.';
      } else
         redirect('/profile');
   }
}
