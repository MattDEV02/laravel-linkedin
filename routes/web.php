<?php

   use App\Http\Controllers\CollegamentiController;
   use App\Http\Controllers\CommentiController;
   use App\Http\Resources\UserCollection;
   use App\Http\Resources\UserResource;
   use App\Models\Reportistica;
   use App\Models\User;
   use Illuminate\Contracts\Foundation\Application;
   use Illuminate\Contracts\View\Factory;
   use Illuminate\Contracts\View\View;
   use Illuminate\Http\Request;
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
   $CC = CommentiController::class;
   $CL = CollegamentiController::class;


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
      ->group(callback: function() use($UC, $PC, $PRC, $CC, $CL): void {
         Route::get('/feed', [$PC, 'feed']);
         Route::get('/commenti/{post_id}', [$CC, 'commenti']);
         Route::get('/edit-profile', [$PRC, 'editProfile']);
         Route::get('/profile', [$PRC, 'profile'])
            ->name('profile');
         Route::get('/show-profile', [$PRC, 'showProfile']);
         Route::get('/collegamenti/{utente_id}', [$CL, 'collegamenti'])
            ->name('collegamenti');
         Route::get('/reportistica', function (): Factory | View | Application {
            $utente_id = session()->get('utente')->id;
            return view('reportistica.index', [
               'user_data' => Reportistica::getAllByUser($utente_id),
               'records' => Reportistica::getAllRecords(),
               'num_users_group_by_nazione' => Reportistica::getNumUsersGroupByNazione(),
               'num_posts_group_by_date' => Reportistica::getNumPostGroupByDate($utente_id),
               'num_likes_group_by_date' => Reportistica::getNumMiPiaceGroupByDate($utente_id),
               'num_comments_group_by_date' => Reportistica::getNumCommentiGroupByDate($utente_id)
            ]);
         })->name('reportistica');
      });

   Route::prefix('form')
      ->group(function() use($UC, $PC, $PRC, $CL): void {
         Route::post('/registrazione', [$UC, 'insert'])
            ->name('insert-user');
         Route::post('login-result', [$UC, 'logResult'])
            ->name('log-result');
         Route::post('/password-dimenticata', [$UC, 'passwordDimenticata'])
            ->name('password-dimenticata');
         Route::middleware('isSessionLogged')
            ->group(function () use($UC, $PC, $PRC, $CL): void {
               Route::delete('/remove-collegamento', [$CL, 'removeCollegamento'])
                  ->name('remove-collegamento');
               Route::post('/feed', [$PC, 'insert'])
                  ->name('insert-post');
               Route::post('/order-by', [$PC, 'orderBy'])
                  ->name('orderBy-post');
               Route::post('/like', [$PC, 'like']);
               Route::put('/edit-profile', [$PRC, 'updateProfile'])
                  ->name('edit-profile');
            });
      });

   Route::middleware('auth:api')->any('/api/users/{user_id?}',
      fn (?int $user_id = null): UserResource | UserCollection => $user_id ?
         new UserResource(User::findOrFail($user_id)) :
         new UserCollection(User::all()));

   Route::any('/test', function(Request $request) {
      return $request->user();
   });