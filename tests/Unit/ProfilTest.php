<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilTest extends TestCase
{
    use RefreshDatabase;

    /**
     * SetUp method PHPUnit Framework
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->loginWithFakeUser();
    }

    /**
     * @group profil-page
     * @test
     *
     * @return void
     */
    public function testProfilPage()
    {
        if ($this->isAuthenticated()) {
            $this->actingAs(Auth::user())
                ->get(route('front.profil', Auth::user()->id));
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group valid-update-profil
     * @test
     */
    public function testValidUpdateProfil()
    {
        if ($this->isAuthenticated()) {
            $attributes = factory(User::class)->raw([
                "name" => 'BilelB',
                "firstname" => 'BekkoucheB'
            ]);
            $this->put('/update-account/' . Auth::user()->id, $attributes);
            $user = User::count();
            $this->assertEquals(1, $user);
            $this->assertEquals('BilelB', $attributes['name']);
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group change-password-page
     * @test
     */
    public function testChangePasswordPage()
    {
        if ($this->isAuthenticated()) {
            $this->actingAs(Auth::user())
                ->get(route('front.edit.password', Auth::user()->id));
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group valid-change-password
     * @test
     */
    public function testValidChangePassword()
    {
        if ($this->isAuthenticated()) {
            $attributes = factory(User::class)->raw([
                'password' => 'myNewPasswordLaravel999'
            ]);
            $this->put('/update-password/' . Auth::user()->id, $attributes);
            $user = User::count();
            $this->assertEquals(1, $user);
            $this->assertEquals('myNewPasswordLaravel999', $attributes['password']);
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group delete-account
     * @test
     */
    public function testDeleteAccount()
    {
        if ($this->isAuthenticated()) {
            $user = factory(User::class)->create();
            $response = $this->delete('/delete-user/' . $user->id);
            $response->assertRedirect(route('front.home'));
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * Login with Fake User
     */
    private function loginWithFakeUser()
    {
        $user = factory(User::class)->create();
        $this->be($user); // is Authenticated
        $this->assertAuthenticated();
    }

    /**
     * No Authenticated, redirect to login url and return status 302
     * @param int $id
     */
    private function authGuardToRedirect(int $id): void
    {
        $response = $this->get('/profil/' . $id);
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

}
