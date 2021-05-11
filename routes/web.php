<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtenteController;
use App\Http\Controllers\PostController;

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

Route::view('/', 'home');

Route::get('/login', [$UC, 'login'])
   ->name('login');

Route::get('/registrazione', [$UC, 'registrazione'])
   ->name('registrazione');

Route::prefix('ricezione-dati')
   ->group(function () {
      $UC = UtenteController::class;
      $PC = PostController::class;
      Route::post('/feed', [$PC, 'insert']);
      Route::post('/registrazione', [$UC, 'insert']);
      Route::post('/edit-profile', [$UC, 'updateProfile']);
      Route::post('/passwordDimenticata', [$UC, 'passwordDimenticata']);
   });

Route::post('/feed', [$UC, 'logResult']);

Route::get('/edit-profile', [$UC, 'editProfile']);

Route::get('/profile', [$UC, 'profile']);

Route::get('show-profile', [$UC, 'showProfile']);

Route::get('counter', function(){
   return view('test');
});