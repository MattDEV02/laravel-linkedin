<?php

   namespace Database\Factories;

   use App\Models\User;
   use Illuminate\Database\Eloquent\Factories\Factory;
   use Illuminate\Support\Facades\Hash;
   use Illuminate\Support\Str;
   use JetBrains\PhpStorm\ArrayShape;


   class UserFactory extends Factory {
      /**
       * The name of the factory's corresponding model.
       *
       * @var string
       */
      protected $model = User::class;

      /**
       * Define the model's default state.
       *
       * @return array
       */
      #[ArrayShape(['nome' => "string", 'cognome' => "string", 'email' => "string", 'password' => "string", 'citta_id' => "int"])]
      public function definition(): array {
         return [
            'nome' => $this->faker->name(),
            'cognome' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make(Str::random(8)),
            'remember_token' => Str::random(10),
            'citta_id' => rand(1, 13)
         ];
      }

      /**
       * Indicate that the model's email address should be unverified.
       *
       * @return Factory
       */
      public function unverified(): Factory {
         return $this->state(function (array $attributes) {
            return [
               'email_verified_at' => null,
            ];
         });
      }
   }
