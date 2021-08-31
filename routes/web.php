<?php

   use App\Models\Commento;
   use App\Models\MiPiace;
   use App\Models\Post;
   use App\Models\Reportistica;
   use App\Models\RichiestaAmicizia;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Route;
   use App\Http\Controllers\UtenteController;
   use App\Http\Controllers\PostController;
   use App\Http\Controllers\ProfileController;


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

   Route::middleware('isSessionLogged')
      ->group(function() use($UC, $PC, $PRC): void {
         Route::get('/feed', [$PC, 'feed']);
         Route::get('/commenti/{post_id}', [$PC, 'commenti']);
         Route::get('/edit-profile', [$PRC, 'editProfile']);
         Route::get('/profile', [$PRC, 'profile'])
            ->name('profile');
         Route::get('/show-profile', [$PRC, 'showProfile']);
         Route::get('/collegamenti/{utente_id}', [$PRC, 'collegamenti'])
            ->name('collegamenti');
         Route::get('/reportistica', fn () => view('reportistica.index', [
            'data' => Reportistica::getAllByUser(1),
            'records' => Reportistica::getAllRecords(),
         ]));
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
               Route::post('/order-by', [$PC, 'orderBy'])
                  ->middleware('isSessionLogged')
                  ->name('order-By-post');
               Route::post('/like', [$PC, 'like'])
                  ->middleware('isSessionLogged');
               Route::put('/edit-profile', [$PRC, 'updateProfile'])
                  ->middleware('isSessionLogged')
                  ->name('edit-profile');
            });
      });

   Route::any('/test', function() {
      return Reportistica::getAllByUser(1);
   });