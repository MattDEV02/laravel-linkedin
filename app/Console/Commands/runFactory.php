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
      protected $signature = 'factory:run {n=1}';

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
         $n = (int) $this->arguments('n');
         if(Utente::factory()->count(20)->create())
            $this->info('Factory data inserted.');
         else
            $this->info('Factory data not inserted.');
         return 1;
      }
   }
