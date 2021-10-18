<?php

   namespace App\Http\Resources;

   use Illuminate\Contracts\Support\Arrayable;
   use Illuminate\Http\Request;
   use Illuminate\Http\Resources\Json\ResourceCollection;
   use JsonSerializable;


   class UserCollection extends ResourceCollection {
      /**
       * Transform the resource collection into an array.
       *
       * @param  Request  $request
       * @return array  |Arrayable | JsonSerializable
       */
      public function toArray($request): array | JsonSerializable | Arrayable {
         return [
            'data' => $this->collection,
            'links' => [
               'self' => 'link-value',
            ],
         ];
      }
   }
