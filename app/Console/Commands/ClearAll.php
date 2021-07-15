<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;


class ClearAll extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'reset';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Reset All the project.';

   private array $commands = [
      'npm install',
      'npm audit fix --force' ,
      'npm cache clean --force',
      'composer clear-cache',
      'composer update',
      'composer install',
      'php artisan clear-compiled',
      'php artisan db:create',
      'php artisan migrate:refresh --seed',
      'php artisan storage:link',
      'php artisan optimize' ,
      'php artisan optimize:clear' ,
      'composer dump-autoload --optimize',
      'composer clear-cache',
      'service nginx restart',
      'service mysql restart',
      'apt clean',
      'apt-get clean',
      'php artisan log:clear',
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
         if(str_contains($command, 'migration'))
            $this->info('Migrations: ');
         $output = shell_exec($command);
         $this->info($output);
      }
      try {
         Session::flush();
         Cookie::forget('password');
         session()->regenerate();
         session()->regenerateToken();
         $this->info('Session and Cookies data deleted.');
      } catch (Exception $e) {
         handleError($e->getMessage());
      }
      return 1;
   }
}
