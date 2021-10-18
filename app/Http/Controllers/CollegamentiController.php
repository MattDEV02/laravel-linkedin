<?php

   namespace App\Http\Controllers;

   use App\Models\RichiestaAmicizia;
   use App\Models\User;
   use Illuminate\Contracts\Foundation\Application;
   use Illuminate\Contracts\View\Factory;
   use Illuminate\Contracts\View\View;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Request;
   use Illuminate\Routing\Redirector;


   class CollegamentiController extends Controller {
      public function collegamenti(Request $req, int $utente_id): Factory | View | Application | RedirectResponse {
         $req->session()->put('cond', true);
         return (User::find($utente_id) !== null) ? view('collegamenti.index', [
            'collegamenti' => RichiestaAmicizia::getCollegamenti($utente_id),
            'utente_profile' => User::getProfileLink($utente_id),
            'profile_id' => $utente_id
         ]) : back();
      }

      public function removeCollegamento(Request $req): Redirector | string | RedirectResponse | Application {
         if(checkRef($req, 'collegamenti')) {
            $req->validate([
               'email' => ['required', 'email', 'min:2', 'max:35']
            ], [
               'required' => ':attribute is Required.',
               'email.email' => 'Inserisci Email valida.',
               'email.min' => 'Email almeno 2 caratteri.',
               'email.max' => 'Email massimo 35 caratteri.',
            ]);
            $utente_id = $req
               ->session()
               ->get('utente')->id;
            $utenteCollegamento = User::where('email', $req->input('email'))->first();
            RichiestaAmicizia::removeCollegamento($utente_id, $utenteCollegamento->id);
            return 'Collegamento deleted.';
         } else
            return redirect('/profile');
      }
   }
