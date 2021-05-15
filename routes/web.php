<?php

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

Route::get('/logout', [$UC, 'logout'])
   ->name('logout');

Route::get('/registrazione', [$UC, 'registrazione'])
   ->name('registrazione');

Route::post('/feed', [$UC, 'logResult']);

Route::get('/edit-profile', [$PRC, 'editProfile']);

Route::get('/profile', [$PRC, 'profile'])
   ->name('profile');

Route::get('show-profile', [$PRC, 'showProfile']);

Route::prefix('ricezione-dati')
   ->group(function () {
      $UC = UtenteController::class;
      $PC = PostController::class;
      $PRC = ProfileController::class;
      Route::post('/registrazione', [$UC, 'insert']);
      Route::post('/feed', [$PC, 'insert']);
      Route::post('/edit-profile', [$PRC, 'updateProfile']);
      Route::post('/passwordDimenticata', [$UC, 'passwordDimenticata']);
   });


