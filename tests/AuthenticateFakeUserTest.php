<?php
namespace Tests;

use App\User;
use Tests\TestCase;

class AuthenticateFakeUserTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->loginWithFakeUser();
    }

    /**
     * Login with Fake User
     */
    protected function loginWithFakeUser()
    {
        $this->user = factory(User::class)->create();
        $this->be($this->user); // is Authenticated
        $this->assertAuthenticated();
    }

    /**
     * No Authenticated, redirect to login url and return status 302
     * @param int $id
     */
    protected function authGuardToRedirect(int $id): void
    {
        $response = $this->get('/profil/' . $id);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
}
