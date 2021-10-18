<?php

   namespace Tests\Feature;

   use Tests\TestCase;


   class HomeTest extends TestCase {
      /**
       * A basic feature test example.
       *
       * @return void
       */
      public function test(): void {
         $response = $this->get('/');
         $response->assertStatus(200);
      }
   }
