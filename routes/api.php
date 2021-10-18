<?php

   use App\Http\Resources\UserCollection;
   use App\Http\Resources\UserResource;
   use App\Models\User;
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


   Route::middleware('auth:api')->any('/api/users/{user_id?}',
      fn (?int $user_id = null): UserResource | UserCollection => $user_id ?
         new UserResource(User::findOrFail($user_id)) :
         new UserCollection(User::all()));