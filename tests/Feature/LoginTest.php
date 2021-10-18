<?php

   namespace Tests\Feature;

   use Tests\TestCase;


   class LoginTest extends TestCase {
      /**
       * A basic feature test example.
       *
       * @return void
       */
      public function test(): void {
         $response = $this->get('/login');
         $response->assertStatus(200);
      }
   }
