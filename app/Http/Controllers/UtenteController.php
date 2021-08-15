<?php

   namespace App\Http\Controllers;

   use App\Models\Post;
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

      public function login(): Factory | View | Application {
         return view('login.index');
      }

      public function registrazione(): Factory | View | Application {
         return view('registrazione.index',[
            'citta' => Citta::all(),
            'lavori' => Lavoro::all()
         ]);
      }

      public function logout(Request $req): RedirectResponse {
         $path = '/login';
         if($req->session()->exists('utente')) {
            Cookie::queue(Cookie::forget('password'));
            $email = $req
               ->session()
               ->get('utente')
               ->email;
            $req
               ->session()
               ->invalidate();
            Log::warning("Finished User-Session ($email).");
            return redirect($path)
               ->withErrors('Ti sei disconnesso, devi effettuare di nuovo il Login.');
         } else
            return redirect($path);
      }

      public function insert(Request $req): RedirectResponse {
         if(checkRef($req, 'registrazione')) {
            $req->validate([
               'email' => ['email', 'required', 'unique:Utente','min:2', 'max:35'],
               'password' => ['required', 'min:8', 'max:8'],
               'nome' => ['required', 'min:3', 'max:45'],
               'cognome' => ['required', 'min:3', 'max:45'],
               'citta' => ['required', 'numeric', 'min:1', 'max:13'],
               'lavoro' => ['required', 'numeric', 'min:1', 'max:15'],
               'dataInizioLavoro' => ['nullable', 'date', 'date_format:Y-m-d']
            ], [
               'required' => ':attribute is Required.',
               'email.email' => 'Inserisci Email valida.',
               'email.min' => 'Email almeno 2 caratteri.',
               'email.max' => 'Email massimo 35 caratteri.',
               'email.unique' => 'Utente già Registrato, è possible effettuare il Login.',
               'password.min' => 'Password con 8 caratteri.',
               'password.max' => 'Password con 8 caratteri.',
               'nome.min' => 'Nome almeno 3 caratteri.',
               'nome.max' => 'Nome massimo 45 caratteri.',
               'cognome.min' => 'Cognome almeno 3 caratteri.',
               'cognome.max' => 'Cognome massimo 45 caratteri.',
               'citta.numeric' => 'Città inserita non valida.',
               'citta.min' => 'Città inserita non valida.',
               'citta.max' => 'Città inserita non valida.',
               'lavoro.numeric' => 'Lavoro inserito non valido.',
               'lavoro.min' => 'Lavoro inserito non valido.',
               'lavoro.max' => 'Lavoro inserito non valido.',
               'dataInizioLavoro.date' => 'Data inizio lavoro is a date.',
               'dataInizioLavoro.date_format' => 'Incorrect date format for Data inizio lavoro.',
               'dataInizioLavoro.before_or_equal' => 'Data inizio lavoro non valida.'
            ]);
            $errors = checkDataInizioLavoroErrors($req);
            if(isValidCollection($errors))
               return back()
                  ->withInput($req->all())
                  ->withErrors($errors);
            else {
               $password = $req->input('password');
               Cookie::queue(Cookie::forever('password', $password));
               $utente = Utente::registrazione($req);
               $utenteEmail = $utente->email;
               sendNotification(Utente::getNomeCognome($utente->id));
               Log::debug("New User inserted ($utenteEmail).");
               return redirect('/login')
                  ->with('msg', 'reg')
                  ->withCookie('password', $password);
            }
         } else
            return redirect('/registrazione');
      }

      public function logResult(Request $req): RedirectResponse {
         $req->validate([
            'email' => ['email', 'required', 'min:2', 'max:35'],
            'password' => ['required', 'min:8', 'max:8'],
         ], [
            'email.email' => 'Inserisci Email valida.',
            'required' => ':attribute is Required.',
            'email.min' => 'Email almeno 2 caratteri.',
            'email.max' => 'Email massimo 35 caratteri.',
            'password.min'  => 'Password con 8 caratteri.',
            'password.max'  => 'Password con 8 caratteri.',
         ]);
         $email = adjustEmail($req->input('email'));
         $password = $req->input('password');
         if(Utente::isLogged($email, $password)) {
            $req->session()->regenerate();
            if(!$req->session()->exists('utente')) {
               sessionPutUser($req);
               Log::info("New User-Session started ($email).");
            }
            return redirect('/feed');
         } else
            return back()
               ->withInput($req->all())
               ->withErrors(['Utente non registrato, è possible farlo.']);
      }

      public function passwordDimenticata(Request $req): bool {
         $req->validate([
            'email' => ['email', 'required', 'min:2', 'max:35'],
            'password' => ['required', 'min:8', 'max:8'],
         ], [
            'email.email' => 'Inserisci Email valida',
            'required' => ':attribute is Required.',
            'email.min' => 'Email almeno 2 caratteri.',
            'email.max' => 'Email massimo 35 caratteri.',
            'password.min'  => 'Password con 8 caratteri.',
         ]);
         $res = false;
         if(checkRef($req, 'login')) {
            $email = adjustEmail($req->input('email'));
            $password = $req->input('password');
            $utente = Utente::where('email', $email)->first();
            if(isset($utente)) {
               $utente->password = Hash::make($password);
               $utente->save();
               Cookie::queue(Cookie::forever('password', $password));
               $res = sendmail($email, $password);
            }
         }
         return $res;
      }
   }
