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
   protected $signature = 'reset';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Reset All the project.';

   private array $commands = [
      'php artisan mnt:off',
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
      'php artisan optimize:clear',
      'composer dump-autoload --optimize',
      'composer clear-cache',
      'php artisan session:delete',
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
      if($this->confirm('Confermi il reset?', true)) {
         foreach($this->commands as $command) {
            if(preg_match('(migration|composer)', $command))
               $this->info('yes');
            $output = shell_exec($command);
            $this->info($output);
         }
      } else
         $this->info('Reset annullato.');
      return 1;
   }
}
