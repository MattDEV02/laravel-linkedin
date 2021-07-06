<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtenteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Utente;


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

Route::get('/logout', [$UC, 'logout'])
   ->name('logout');

Route::get('/registrazione', [$UC, 'registrazione'])
   ->name('registrazione');

Route::match(['GET', 'POST'], '/feed', [$UC, 'logResult']);

Route::middleware('isSessionLogged')
   ->group(function() use($UC, $PC, $PRC) {
      Route::get('/edit-profile', [$PRC, 'editProfile']);
      Route::get('/profile', [$PRC, 'profile'])
         ->name('profile');
      Route::get('/show-profile', [$PRC, 'showProfile']);
      Route::get('/collegamenti', [$PRC, 'collegamenti'])
         ->name('collegamenti');
   });

Route::prefix('ricezione-dati')
   ->group(function () use($UC, $PC, $PRC) {
      Route::post('/registrazione', [$UC, 'insert'])
         ->name('insert-user');
      Route::post('/passwordDimenticata', [$UC, 'passwordDimenticata']);
      Route::post('/remove-collegamento', [$PRC, 'removeCollegamento'])
         ->name('remove-collegamento');
      Route::post('/feed', [$PC, 'insert'])
         ->name('insert-post')
         ->middleware('isSessionLogged');
      Route::post('/orderBy', [$PC, 'orderBy'])
         ->name('orderBy-post')
         ->middleware('isSessionLogged');
      Route::post('/like', [$PC, 'like'])
         ->middleware('isSessionLogged');
      Route::post('/edit-profile', [$PRC, 'updateProfile'])
         ->name('edit-profile')
         ->middleware('isSessionLogged');
   });

