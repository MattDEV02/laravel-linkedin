<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtenteController;

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

Route::view('/', 'home');

Route::get('/login', [$UC, 'login'])
   ->name('login');

Route::get('/registrazione', [$UC, 'registrazione'])
   ->name('registrazione');

Route::prefix('ricezione-dati')
   ->group(function () {
      $UC = UtenteController::class;
      Route::post('/login', [$UC, 'logResult']);
      Route::post('/registrazione', [$UC, 'insert']);
      Route::post('/passwordDimenticata', [$UC, 'passwordDimenticata']);
   });

Route::get('/feed', [$UC, 'feed']);

Route::get('/profile', [$UC, 'profile']);

Route::get('/passwordDimenticata', [$UC, 'passwordDimenticata']);

