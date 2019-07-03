<?php

namespace Tests\Unit;

use App\Tag;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\AuthenticateFakeUserTest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsTest extends AuthenticateFakeUserTest
{

    /**
     * @group tag-page
     * @test
     */
    public function testPageTag()
    {
        if ($this->isAuthenticated()) {
            $this->user = factory(User::class)->create([
                "roles" => "s:10:'ROLE_ADMIN';"
            ]);
            $this->actingAs($this->user)
                ->get(route('admin.tag.index'));
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group tag-create-page
     * @test
     */
    public function testCreateTagPage()
    {
        if ($this->isAuthenticated()) {
            $this->user = factory(User::class)->create([
                "roles" => "s:10:'ROLE_ADMIN';"
            ]);
            $this->actingAs($this->user)
                ->get(route('admin.tag.create'));
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group valid-create-tag
     * @test
     */
    public function testValidCreateTag()
    {
        if ($this->isAuthenticated()) {
            $this->user = factory(User::class)->create([
                "roles" => "s:10:'ROLE_ADMIN';"
            ]);
            $attributes = factory(Tag::class)->raw();
            $tag = $this->post(route('admin.tag.store'), $attributes);
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group not-valid-create-tag
     * @test
     */
    public function testNotValidCreateTag()
    {

    }

    /**
     * @group tag-edit-page
     * @test
     */
    public function testEditTagPage()
    {

    }

    /**
     * @group valid-update-tag
     * @test
     */
    public function testValidUpdateTag()
    {

    }

    /**
     * @group not-valid-update-tag
     * @test
     */
    public function testNotValidUpdateTag()
    {

    }

    /**
     * @group delete-tag
     * @test
     */
    public function testDeleteTag()
    {

    }

}
