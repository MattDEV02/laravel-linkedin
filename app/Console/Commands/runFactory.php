<?php

   namespace App\Console\Commands;

   use App\Models\User;
   use Illuminate\Console\Command;


   class runFactory extends Command {
      /**
       * The name and signature of the console command.
       *
       * @var string
       */
      protected $signature = 'factory:run {--n=1}';

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
      public function __construct() {
         parent::__construct();
      }

      /**
       * Execute the console command.
       *
       * @return int
       */
      public function handle(): int {
         $n = (int) $this->option('n');
         User::factory()->count($n)->create() ?
            $this->info("$n factory data inserted.") : $this->info("$n factory data not inserted.");
         return 1;
      }
   }
