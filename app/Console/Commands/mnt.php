<?php

   namespace App\Console\Commands;

   use Illuminate\Console\Command;
   use Illuminate\Support\Facades\Artisan;


   class mnt extends Command {
      /**
       * The name and signature of the console command.
       *
       * @var string
       */
      protected $signature = 'mnt {switch=on}';

      /**
       * The console command description.
       *
       * @var string
       */
      protected $description = 'Activate maintenance mode.';

      private string $view = 'utils.manutenzione';

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
         if($this->confirm('Confermi la tua scelta?')) {
            $command = $this->argument('switch') === 'off' ? 'up' : 'down --render=' . $this->view;
            Artisan::call($command);
            $this->info(Artisan::output());
         } else
            $this->info('Operazione annullata.');
         return 1;
      }
   }
