<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    /**
     * @group home-page
     * @test
     *
     * @return void
     */
    public function testHomePage()
    {
        $response = $this->get(route('front.home'));
        $response->assertStatus(200);
        $response->assertSuccessful();
    }

}
