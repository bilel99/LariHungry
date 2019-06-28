<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group register-page
     * @test
     * The registration form can be displayed.
     *
     * @return void
     */
    public function testRegisterFormDisplayed()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }
    /**
     * @group valid-register
     * @test
     * A valid user can be registered.
     *
     * @return void
     */
    public function testRegistersAValidUser()
    {
        $attributes = factory(User::class)->make();
        $response = $this->post('register', [
            'name' => $attributes->name,
            'firstname' => $attributes->firstname,
            'email' => $attributes->email,
            'password' => $attributes->password,
            'password_confirmation' => $attributes->password
        ]);
        $user = User::count();
        $this->assertEquals(1, $user);
        $response->assertStatus(302);
        $this->assertAuthenticated();
    }

    /**
     * @group not-valid-register
     * @test
     * An invalid user is not registered.
     *
     * @return void
     */
    public function testDoesNotRegisterAnInvalidUser()
    {
        $attributes = factory(User::class)->make();
        $response = $this->post('register', [
            'name' => $attributes->name,
            'firstname' => $attributes->firstname,
            'email' => $attributes->email,
            'password' => 'mynewpassword',
            'password_confirmation' => 'invalidpassword'
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

}
