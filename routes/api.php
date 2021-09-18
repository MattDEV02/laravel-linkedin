<?php

   use App\Models\Utente;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Route;


   /*
   |--------------------------------------------------------------------------
   | API Routes
   |--------------------------------------------------------------------------
   |
   | Here is where you can register API routes for your application. These
   | routes are loaded by the RouteServiceProvider within a group which
   | is assigned the "api" middleware group. Enjoy building your API!
   |
   */

   Route::middleware('auth:api')
      ->get('/user', function (Request $request) {
         return $request->user();
   });

   Route::middleware('auth:api')
      ->any('/api/users/{user_id?}',
         fn (?int $user_id = null): Utente | Collection | null =>
         $user_id ? Utente::findOrFail($user_id) : Utente::all());