<?php

   namespace App\Models;

   use Illuminate\Contracts\Auth\MustVerifyEmail;
   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Foundation\Auth\User as Authenticatable;
   use Illuminate\Notifications\Notifiable;
   //use Laravel\Sanctum\HasApiTokens;
   use Illuminate\Database\Eloquent\Builder;
   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Hash;
   use Illuminate\Support\Str;


   /**
    * @method static bool isLogged(string $email, string $password)
    * @method static Utente registrazione(array $data)
    * @method static Utente getProfileLink(int $utente_id)
    * @method static string getNomeCognome(int $utente_id)
    * @property int id
    * @property string email
    * @property string password
    * @property string nome
    * @property string cognome
    * @property int citta_id
    * @property string api_token
    * @property int created_at
    * @property int updated_at
    */
   class User extends Authenticatable {

      use HasFactory, Notifiable;

      protected $table = 'Utente';
      public $timestamps = true;

      /**
       * The attributes that are mass assignable.
       *
       * @var string[]
       */
      protected $fillable = [
         'nome',
         'cognome',
         'email',
         'password',
         'remember_token'
      ];

      /**
       * The attributes that should be hidden for serialization.
       *
       * @var array
       */
      protected $hidden = [
         'password',
         'api_token',
         'remember_token'
      ];

      public function scopeIsLogged(Builder $query, string $email, string $password): bool {
         $attr = ['email', 'password'];
         $utente = User::select($attr)
            ->where($attr[0], $email)
            ->first();
         return isset($utente) && Hash::check($password, $utente->password);
      }

      public function scopeRegistrazione(Builder $query, array $data): User {
         $utente = new User();
         $utente->email = adjustEmail($data['email']);
         $utente->password = Hash::make($data['password']);
         $utente->nome = Str::ucfirst($data['nome']);
         $utente->cognome = Str::ucfirst($data['cognome']);
         $utente->citta_id = $data['citta'];
         $utente->save();
         $lavoro_id = $data['lavoro'];
         UtenteLavoro::where('utente_id', $utente->id)
            ->update([
               'lavoro_id' => $lavoro_id,
               'dataInizioLavoro' => $data['dataInizioLavoro']
            ]);
         return $utente;
      }

      public function scopeGetProfileLink(Builder $query, int $utente_id): User {
         return User::select([
            'email',
            DB::raw("CONCAT(nome, ' ', cognome) AS nomeCognome")
         ])->find($utente_id);
      }

      public function scopeGetNomeCognome(Builder $query, int $utente_id): string {
         return User::select([
            DB::raw("CONCAT(nome, ' ', cognome) AS nomeCognome")
         ])
            ->find($utente_id)
            ->nomeCognome;
      }
   }