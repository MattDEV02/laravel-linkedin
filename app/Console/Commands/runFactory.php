<?php

   namespace App\Console\Commands;

   use App\Models\Utente;
   use Illuminate\Console\Command;


   class runFactory extends Command
   {
      /**
       * The name and signature of the console command.
       *
       * @var string
       */
      protected $signature = 'factory:run';

      /**
       * The console command description.
       *
       * @var string
       */
      protected $description = 'Run all Factories.';

      /**
       * Create a new command instance.
       *
       * @return void
       */
      public function __construct()
      {
         parent::__construct();
      }

      /**
       * Execute the console command.
       *
       * @return int
       */
      public function handle(): int {
         Utente::factory()->count(10)->create();
         $this->info('Factory data inserted.');
         return 1;
      }
   }
