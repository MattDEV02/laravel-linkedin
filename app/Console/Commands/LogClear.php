<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LogClear extends Command {
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'log:clear';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Clear laravel.log file.';

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
   public function handle(): int
   {
      $path = storage_path('logs/laravel.log');
      exec("echo '' > $path");
      $this->info('Logs have been cleared.');
      return 1;
   }
}
