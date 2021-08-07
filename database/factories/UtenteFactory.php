<?php

   namespace Database\Factories;

   use App\Models\Utente;
   use Illuminate\Database\Eloquent\Factories\Factory;
   use Illuminate\Support\Facades\Hash;
   use Illuminate\Support\Str;
   use JetBrains\PhpStorm\ArrayShape;


   class UtenteFactory extends Factory {
      /**
       * The name of the factory's corresponding model.
       *
       * @var string
       */
      protected $model = Utente::class;

      /**
       * Define the model's default state.
       *
       * @return array
       */
      #[ArrayShape(['nome' => "string", 'cognome' => "string", 'email' => "mixed", 'password' => "string", 'citta_id' => "int"])] public function definition(): array {
         return [
            'nome' => $this->faker->name(),
            'cognome' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make(Str::random(8)),
            'citta_id' => rand(1, 13)
         ];
      }
   }
