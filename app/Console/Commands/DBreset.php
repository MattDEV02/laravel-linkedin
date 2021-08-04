<?php

   namespace App\Console\Commands;

   use Illuminate\Console\Command;
   use Illuminate\Support\Str;

   class DBreset extends Command
   {
      /**
       * The name and signature of the console command.
       *
       * @var string
       */
      protected $signature = 'db:reset';

      /**
       * The console command description.
       *
       * @var string
       */
      protected $description = 'Reset DB';

      private array $commands = [
         'php artisan db:create',
         'php artisan migrate:refresh --seed',
      ];


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
         foreach($this->commands as $command) {
            if(Str::contains($command, 'migrat'))
               $this->info('yes');
            $output = shell_exec($command);
            $this->info($output);
         }
         $this->info(env('DB_DATABASE') . ' Schema resetted.');
         return 1;
      }
   }
