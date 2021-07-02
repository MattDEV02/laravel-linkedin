<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearAll extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'clear:all';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Clear All.';

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
      shell_exec('php artisan log:clear');
      shell_exec('php artisan db:create');
      shell_exec('php artisan migrate:refresh --seed');
      shell_exec('php artisan storage:link');
      shell_exec('php artisan optimize');
      shell_exec('php artisan optimize:clear');
      shell_exec('composer clear-cache');
      shell_exec('composer dump-autoload --optimize');
      $this->info('Cleared all.');
      return 1;
   }
}
