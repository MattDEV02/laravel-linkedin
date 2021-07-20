<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;


class DeleteSessionData extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'session:delete';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Delete Session Data.';

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
      try {
         Session::flush();
         Cookie::queue(Cookie::forget('password'));
         $session_files = File::allFiles(storage_path('framework/sessions'));
         $bootstrap_files = File::allFiles("bootstrap/cache");
         $directories = [$bootstrap_files, $session_files];
         foreach($directories as $directory)
            File::delete($directory);
         session()->regenerate();
         session()->regenerateToken();
         $this->info('Session data deleted.');
      } catch (Exception $e) {
         $msg = $e->getMessage();
         $this->alert($msg);
         Log::error($msg);
      }
      return 1;
   }
}
