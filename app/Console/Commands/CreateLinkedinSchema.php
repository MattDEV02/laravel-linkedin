<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class CreateLinkedinSchema extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'db:create';

   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Create a MySQL Schema named Linkedin.';

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
      $schema = 'Linkedin';
      DB::statement("DROP SCHEMA IF EXISTS $schema;");
      $result = (int) DB::statement("CREATE SCHEMA IF NOT EXISTS $schema;");
      $out = $result ? 'Schema Created.' : 'Schema not Created.';
      $this->info($out);
      return $result;
   }
}
