<?php

namespace Tests\Unit;

use App\Models\Utente;
use PHPUnit\Framework\TestCase;


class FunctionsTest extends TestCase
{
   /**
    * A basic unit test example.
    *
    * @return void
    */
   public function test_example()
   {
      $value = consoleLog("test");
      $this->assertEquals("test", $value);
   }
}
