<?php

   use App\Models\Reportistica;
   use App\Models\Utente;
   use Illuminate\Contracts\Foundation\Application;
   use Illuminate\Contracts\View\Factory;
   use Illuminate\Contracts\View\View;
   use Illuminate\Http\Request;
   use Illuminate\Support\Collection;
   use Illuminate\Support\Facades\Route;
   use App\Http\Controllers\UtenteController;
   use App\Http\Controllers\PostController;
   use App\Http\Controllers\ProfileController;
   use Illuminate\Http\RedirectResponse;
   use Symfony\Component\HttpFoundation\BinaryFileResponse;


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

   Route::any('home', fn(): RedirectResponse => redirect('/'));

   Route::get('/login', [$UC, 'login'])
      ->name('login');

   Route::match(['GET', 'POST'], '/logout', [$UC, 'logout'])
      ->name('logout');

   Route::get('/registrazione', [$UC, 'registrazione'])
      ->name('registrazione');

   Route::get('password-dimenticata', [$UC, 'passwordDimenticataView']);

   Route::get('/docs' , function(): BinaryFileResponse {
      $filePath = public_path() . '\docs.pdf';
      return response()->file($filePath, [
         'Content-Type' => 'application/pdf'
      ]);
   });

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
         Route::get('/reportistica', fn (): Factory | View | Application => view('reportistica.index', [
            'user_data' => Reportistica::getAllByUser(session()->get('utente')->id),
            'records' => Reportistica::getAllRecords(),
         ]));
      });

   Route::prefix('form')
      ->group(function() use($UC, $PC, $PRC): void {
         Route::post('/registrazione', [$UC, 'insert'])
            ->name('insert-user');
         Route::post('login-result', [$UC, 'logResult'])
            ->name('log-result');
         Route::post('/password-dimenticata', [$UC, 'passwordDimenticata'])
            ->name('password-dimenticata');
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
                  ->name('orderBy-post');
               Route::post('/like', [$PC, 'like'])
                  ->middleware('isSessionLogged');
               Route::put('/edit-profile', [$PRC, 'updateProfile'])
                  ->middleware('isSessionLogged')
                  ->name('edit-profile');
            });
      });

   Route::middleware('auth:api')
      ->any('/api/users/{user_id?}',
         fn (?int $user_id = null): Utente | Collection | null =>
            $user_id ? Utente::findOrFail($user_id) : Utente::all());

   Route::any('/test', function(Request $request) {
      return [
         'data' => Reportistica::getAllByUser(1),
         'records' => Reportistica::getAllRecords(),
      ];
   });