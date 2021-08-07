<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Builder;
   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\DB;
   use Illuminate\Support\Facades\Hash;


   /**
    * @method static isLogged(string $email, mixed $password)
    * @method static registrazione(Request $req)
    * @method static getProfileLink(int $utente_id)
    * @property string email
    * @property string password
    * @property string nome
    * @property string cognome
    * @property int citta_id
    * @property int id
    */
   class Utente extends Model {

      use HasFactory;

      protected $table = 'Utente';
      public $timestamps = true;


      public function scopeIsLogged(Builder $query, string $email, ?string $password = null): bool {
         $attr = ['email', 'password'];
         $utente = Utente::select($attr)
            ->where($attr[0], $email)
            ->first();
         $cond = isset($utente);
         return isset($password) ?
            $cond && (
               Hash::check($password, $utente->password) ||
               $password === $utente->password
            ) : $cond;
      }

      public function scopeRegistrazione(Builder $query, Request $data): string {
         $utente = new Utente();
         $utente->email = adjustEmail($data->input('email'));
         $password = $data->input('password');
         $utente->password = Hash::make($password);
         $utente->nome = ucfirst($data->input('nome'));
         $utente->cognome = ucfirst($data->input('cognome'));
         $utente->citta_id = $data->input('citta');
         $utente->save();
         $utente_id = $utente->id;
         $utenteLavoro = new UtenteLavoro();
         $utenteLavoro->utente_id = $utente_id;
         $utenteLavoro->lavoro_id = $data->input('lavoro');
         $utenteLavoro->dataInizioLavoro = $data->input('dataInizioLavoro');
         $utenteLavoro->save();
         return $utente->email;
      }

      public function scopeGetProfileLink(Builder $query, int $utente_id) {
         return Utente::select([
            'email',
            DB::raw("CONCAT(nome, ' ', cognome) AS nomeCognome")
         ])->find($utente_id);
      }
   }