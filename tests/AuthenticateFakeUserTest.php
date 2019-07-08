<?php

namespace Tests;

use App\User;
use Tests\TestCase;

class AuthenticateFakeUserTest extends TestCase
{
    protected $user;

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
     * Login with Fake Admin User
     */
    protected function loginWithFakeAdminUser()
    {
        $user = factory(User::class)->create([
            "id" => 92,
            "media_id" => null,
            "name" => "Admin",
            "firstname" => "Admin",
            "email" => "admin@admin.fr",
            "password" => "myNewPassword999",
            "roles" => "s:10:'ROLE_ADMIN';",
            "is_active" => true
        ]);
        $this->be($user);
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
