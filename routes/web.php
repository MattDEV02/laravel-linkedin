<?php

   use App\Models\Utente;
   use Illuminate\Mail\Mailable;
   use Illuminate\Support\Facades\Cookie;
   use Illuminate\Support\Facades\Mail;
   use Illuminate\Support\Facades\Route;
   use App\Http\Controllers\UtenteController;
   use App\Http\Controllers\PostController;
   use App\Http\Controllers\ProfileController;
   use App\Mail\PasswordDimenticata;


   /*
   |--------------------------------------------------------------------------
   | Web Routes
   |--------------------------------------------------------------------------
   |
   | Here is where you can register web routes for your application. These
   | routes are loaded by the RouteServiceProvider within a group which
   | contains the "web" middleware group. Now create something great!
   |
   */

   $UC = UtenteController::class;
   $PC = PostController::class;
   $PRC = ProfileController::class;


   Route::view('/', 'home');

   Route::any('home', fn() => redirect('/'));

   Route::get('/login', [$UC, 'login'])
      ->name('login');

   Route::match(['GET', 'POST'], '/logout', [$UC, 'logout'])
      ->name('logout');

   Route::get('/registrazione', [$UC, 'registrazione'])
      ->name('registrazione');

   Route::get('/feed', [$PC, 'feed']);

   Route::middleware('isSessionLogged')
      ->group(function() use($UC, $PC, $PRC): void {
         Route::get('/commenti/{post_id}', [$PC, 'commenti']);
         Route::get('/edit-profile', [$PRC, 'editProfile']);
         Route::get('/profile', [$PRC, 'profile'])
            ->name('profile');
         Route::get('/show-profile', [$PRC, 'showProfile']);
         Route::get('/collegamenti/{utente_id}', [$PRC, 'collegamenti'])
            ->name('collegamenti');
      });

   Route::prefix('ricezione-dati')
      ->group(function() use($UC, $PC, $PRC): void {
         Route::post('/registrazione', [$UC, 'insert'])
            ->name('insert-user');
         Route::post('login-result', [$UC, 'logResult'])
            ->name('log-result');
         Route::post('/password-dimenticata', [$UC, 'passwordDimenticata']);
         Route::middleware('isSessionLogged')
            ->group(function () use($UC, $PC, $PRC): void {
               Route::delete('/remove-collegamento', [$PRC, 'removeCollegamento'])
                  ->middleware('isSessionLogged')
                  ->name('remove-collegamento');
               Route::post('/feed', [$PC, 'insert'])
                  ->middleware('isSessionLogged')
                  ->name('insert-post');
               Route::post('/orderBy', [$PC, 'orderBy'])
                  ->middleware('isSessionLogged')
                  ->name('orderBy-post');
               Route::post('/like', [$PC, 'like'])
                  ->middleware('isSessionLogged');
               Route::put('/edit-profile', [$PRC, 'updateProfile'])
                  ->middleware('isSessionLogged')
                  ->name('edit-profile');
            });
      });

   Route::any('test', function() {
      Mail::send('utils.password-dimenticata', [
         'email' => 'matteolambertucci3@gmail.com',
         'password' => '12345678'
      ],
         function($message) {
            $message
               ->to('matteolambertucci3@gmail.com', 'Mailable')
               ->subject('Linkedin password reset');
         });
   });