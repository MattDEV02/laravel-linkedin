<?php

   namespace App\Http\Resources;

   use Illuminate\Contracts\Support\Arrayable;
   use Illuminate\Http\Request;
   use Illuminate\Http\Resources\Json\JsonResource;
   use JetBrains\PhpStorm\ArrayShape;
   use JsonSerializable;


   /**
    * @property int id
    * @property string nome
    * @property string cognome
    * @property string email
    * @property string password
    * @property string api_token
    * @property string created_at
    * @property string updated_at
    */
   class UserResource extends JsonResource {
      /**
       * Transform the resource into an array.
       *
       * @param Request $request
       * @return array
       */
      #[ArrayShape(['id' => "int", 'nome' => "string", 'cognome' => "string", 'email' => "string", 'password' => "string", 'api_token' => "string", 'created_at' => "string", 'updated_at' => "string"])] public function toArray($request): array {
         return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cognome' => $this->cognome,
            'email' => $this->email,
            'password' => $this->password,
            'api_token' => $this->api_token,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
         ];
      }
   }
