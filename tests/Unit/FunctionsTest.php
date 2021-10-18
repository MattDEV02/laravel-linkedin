<?php

   namespace Tests\Unit;

   use PHPUnit\Framework\TestCase;


   class FunctionsTest extends TestCase {
      /**
       * A basic unit test example.
       *
       * @return void
       */
      public function test_example(): void {
         $value = consoleLog('test');
         $this->assertEquals('test', $value);
      }
   }
