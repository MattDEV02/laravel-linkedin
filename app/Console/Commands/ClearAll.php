<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

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

   private array $commands = [
      'php artisan log:clear',
      'php artisan db:create',
      'php artisan migrate:refresh --seed',
      'php artisan storage:link',
      'php artisan optimize' ,
      'php artisan optimize:clear' ,
      'composer dump-autoload --optimize',
      'composer clear-cache'
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
   public function handle(): int
   {
      $commands_ = $this->commands;
      foreach($commands_ as $command) {
         $output = shell_exec($command);
         $this->info($output);
      }
      try {
         Http::get(route('logout'))
            ->throw();
         $this->info('Session data deleted.');
      } catch (RequestException $e) {
         handleError($e->getMessage());
      }
      return 1;
   }
}
