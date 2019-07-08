<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\AuthenticateFakeUserTest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestaurantTest extends AuthenticateFakeUserTest
{
    use RefreshDatabase;
    use WithoutMiddleware;

    
}
