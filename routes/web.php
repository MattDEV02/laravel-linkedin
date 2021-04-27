<?php

use App\Models\UtenteLavoro;
use Illuminate\Support\Facades\Route;
use App\Models\Nazione;
use App\Models\Citta;
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


Route::get('/', function () {
   return Utente::joinRelationship('UtenteLavoro')
      ->toSql();
});


