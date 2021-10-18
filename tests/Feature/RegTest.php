<?php

   namespace Tests\Feature;

   use Tests\TestCase;


   class RegTest extends TestCase {
      /**
       * A basic feature test example.
       *
       * @return void
       */
      public function test_example(): void {
         $response = $this->get('/registrazione');
         $response->assertStatus(200);
      }
   }
