<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    /**
     * @test
     * A basic unit test example.
     *
     * @return void
     */
    public function testContactPage()
    {
        //$response = $this->get(route('front.contact'));
        //$response->assertSuccessful();
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }
}
