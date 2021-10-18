<?php

   namespace App\Http\Controllers;

   use App\Models\Profilo;
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
   use App\Models\User;


   class ProfileController extends Controller {

      public function profile(Request $req): Factory | View | Application {
         $utente_id = $req->session()->get('utente')->id;
         return view('profile.index', [
            'profile' => Profilo::getAll($utente_id),
            'richieste' => RichiestaAmicizia::getRichieste($utente_id),
            'posts' => Post::getAll($utente_id, true),
            'own_profile' => true
         ]);
      }

      public function editProfile(Request $req): Factory | View | Application | RedirectResponse {
         if(checkRef($req, 'profile') || checkRef($req, 'show-profile') || checkRef($req, 'edit-profile')) {
            $utente = $req
               ->session()
               ->get('utente');
            return view('profile.utils.form', [
               'profilo' => Profilo::getAll($utente->id),
               'lavori' => Lavoro::all(),
               'citta' => Citta::all()
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
            'descrizione' => ['nullable', 'min:2' , 'max:255']
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
            'descrizione.min' => 'Testo della descrizione troppo lungo (min: 2).',
            'descrizione.max' => 'Testo della descrizione troppo lungo (max: 255).'
         ]);
         $errors = checkDataInizioLavoroErrors($req);
         if(isValidCollection($errors))
            return back()
               ->withErrors($errors);
         else {
            $utenteProfileUpdated = Profilo::updateProfile($req);
            Log::debug("User $utenteProfileUpdated updated his profile.");
            return redirect('/profile')
               ->with('msg', 'Profile updated successful.');
         }
      }
      public function showProfile(Request $req): Factory | View | Application {
         $emailSearched = $req->query('search');
         consoleLog("Profile searched:  ($emailSearched)");
         $utente = $req
            ->session()
            ->get('utente');
         $utenteSearched = User::where('email', $emailSearched)->first();
         if(isset($utenteSearched)) {
            $utente_id = $utente->id;
            $utenteSearched_id = $utenteSearched->id;
            $profile = Profilo::getAll($utenteSearched_id);
            $own_profile = $profile->utente_id === $utente_id;
            return view('profile.index', [
               'profile' => $profile,
               'richieste' => $own_profile ? RichiestaAmicizia::getRichieste($utente_id) : null,
               'posts' => Post::getAll($utenteSearched_id, true),
               'own_profile' => $own_profile,
            ]);
         } else {
            Log::error("User ($emailSearched) NOT FOUND.");
            return view('utils.user-not-found');
         }
      }
   }
