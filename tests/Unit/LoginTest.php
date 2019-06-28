<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group login-page
     * @test
     * The login form can be displayed.
     *
     * @return void
     */
    public function testLoginFormDisplayed()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSuccessful();
    }

    /**
     * @group valid-auth-login
     * @test
     * A valid user can be logged in.
     *
     * @return void
     */
    public function testLoginAValidUser()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'secret'),
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password
        ]);
        $response->assertRedirect(route('front.home'));
        $this->assertAuthenticatedAs($user);
    }

    /**
     * @group not-valid-auth-login
     * @test
     * An invalid user cannot be logged in.
     *
     * @return void
     */
    public function testDoesNotLoginAnInvalidUser()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('secret')
        ]);
        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'invalid-password'
        ]);
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    /**
     * @group auth-remember-me
     * @test
     * @throws \Exception
     */
    public function test_remember_me_functionality()
    {
        $user = factory(User::class)->create([
            'id' => random_int(1, 100),
            'password' => bcrypt($password = 'secret')
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);
        $response->assertRedirect('/');
        // cookie assertion goes here
        $this->assertAuthenticatedAs($user);
        $response->assertCookie(Auth::guard()->getRecallerName(), vsprintf('%s|%s|%s', [
            $user->id,
            $user->getRememberToken(),
            $user->password,
        ]));
    }

    /**
     * @group logout
     * @test
     * A logged in user can be logged out.
     *
     * @return void
     */
    public function testLogoutAnAuthenticatedUser()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/logout');
        $response->assertStatus(302);
        $this->assertGuest();
    }

}
