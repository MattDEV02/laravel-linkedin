<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegTest extends TestCase
{
   /**
    * A basic feature test example.
    *
    * @return void
    */
   public function test_example()
   {
      $response = $this->get('/registrazione');
      $response->assertStatus(200);
   }
}
