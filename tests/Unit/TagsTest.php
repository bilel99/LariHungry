<?php

namespace Tests\Unit;

use App\Tag;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Tests\AuthenticateFakeUserTest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsTest extends AuthenticateFakeUserTest
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function setUp(): void
    {
        parent::setUp();
        $this->loginWithFakeAdminUser();
    }

    /**
     * @group tag-page
     * @test
     */
    public function testPageTag()
    {
        if ($this->isAuthenticated()) {
            $this->actingAs(Auth::user())
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
            $this->actingAs(Auth::user())
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
            $attributes = factory(Tag::class)->raw();
            $this->post(route('admin.tag.store'), $attributes);
            $tag = Tag::count();
            $this->assertEquals(1, $tag);
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
        if ($this->isAuthenticated()) {
            $response = $this->post(route('admin.tag.store'), [
                'tag' => 'a'
            ]);
            $response->assertSessionHasErrors();
            $this->assertNull(Tag::first());
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group tag-edit-page
     * @test
     */
    public function testEditTagPage()
    {
        if ($this->isAuthenticated()) {
            $tag = factory(Tag::class)->create();
            $this->actingAs(Auth::user())
                ->get(route('admin.tag.edit', $tag->id));
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group valid-update-tag
     * @test
     */
    public function testValidUpdateTag()
    {
        if ($this->isAuthenticated()) {
            $attributes = factory(Tag::class)->raw([
                'id' => 1,
                'tag' => 'Je modifie mon tag'
            ]);
            $this->put(route('admin.tag.update', $attributes['id']), $attributes);
            $tag = Tag::count();
            $this->assertEquals(1, $tag);
            $this->assertEquals('Je modifie mon tag', $attributes['tag']);
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group not-valid-update-tag
     * @test
     */
    public function testNotValidUpdateTag()
    {
        if ($this->isAuthenticated()) {
            $attributes = factory(Tag::class)->create([
                'id' => 1,
                'tag' => 'Mon premier tag'
            ]);
            $edit = factory(Tag::class)->raw([
                'id' => 1,
                'tag' => 'j'
            ]);
            $this->put(route('admin.tag.update', $edit['id']), [
                'tag' => 'j'
            ]);
            $this->assertEquals('Mon premier tag', $attributes->tag);
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group delete-tag
     * @test
     */
    public function testDeleteTag()
    {
        if ($this->isAuthenticated()) {
            $attributes = factory(Tag::class)->raw([
                'id' => 1,
                'tag' => 'Mon premier tag'
            ]);
            $this->delete(route('admin.tag.destroy', $attributes['id']));
            $tag = Tag::count();
            $this->assertEquals(0, $tag);
            $this->assertNull(Tag::first());
        } else {
            $this->authGuardToRedirect(1);
        }
    }

}
