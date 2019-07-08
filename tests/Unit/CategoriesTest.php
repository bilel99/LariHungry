<?php

namespace Tests\Unit;

use App\Categorie;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Tests\AuthenticateFakeUserTest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesTest extends AuthenticateFakeUserTest
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function setUp(): void
    {
        parent::setUp();
        $this->loginWithFakeAdminUser();
    }

    /**
     * @group category-page
     * @test
     */
    public function testPageCategory()
    {
        if ($this->isAuthenticated()) {
            $this->actingAs(Auth::user())
                ->get(route('admin.categories.index'));
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group category-create-page
     * @test
     */
    public function testCreateCategoryPage()
    {
        if ($this->isAuthenticated()) {
            $this->actingAs(Auth::user())
                ->get(route('admin.categories.create'));
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group valid-create-category
     * @test
     */
    public function testValidCreateCategory()
    {
        if ($this->isAuthenticated()) {
            $attributes = factory(Categorie::class)->raw();
            $this->post(route('admin.categories.store'), $attributes);
            $category = Categorie::count();
            $this->assertEquals(1, $category);
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group not-valid-create-category
     * @test
     */
    public function testNotValidCreateCategory()
    {
        if ($this->isAuthenticated()) {
            $response = $this->post(route('admin.categories.store'), [
                'title' => 'a'
            ]);
            $response->assertSessionHasErrors();
            $this->assertNull(Categorie::first());
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group category-edit-page
     * @test
     */
    public function testEditCategoryPage()
    {
        if ($this->isAuthenticated()) {
            $category = factory(Categorie::class)->create();
            $this->actingAs(Auth::user())
                ->get(route('admin.categories.edit', $category->id));
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group valid-update-category
     * @test
     */
    public function testValidUpdateCategory()
    {
        if ($this->isAuthenticated()) {
            $attributes = factory(Categorie::class)->raw([
                'id' => 1,
                'title' => 'Je modifie ma category'
            ]);
            $this->put(route('admin.categories.update', $attributes['id']), $attributes);
            $category = Categorie::count();
            $this->assertEquals(1, $category);
            $this->assertEquals('Je modifie ma category', $attributes['title']);
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group not-valid-update-category
     * @test
     */
    public function testNotValidUpdateCategory()
    {
        if ($this->isAuthenticated()) {
            $attributes = factory(Categorie::class)->create([
                'id' => 1,
                'title' => 'Mon premier titre'
            ]);
            $edit = factory(Categorie::class)->raw([
                'id' => 1,
                'title' => 'j'
            ]);
            $this->put(route('admin.categories.update', $edit['id']), [
                'title' => 'j'
            ]);
            $this->assertEquals('Mon premier titre', $attributes->title);
        } else {
            $this->authGuardToRedirect(1);
        }
    }

    /**
     * @group delete-category
     * @test
     */
    public function testDeleteCategory()
    {
        if ($this->isAuthenticated()) {
            $attributes = factory(Categorie::class)->raw([
                'id' => 1,
                'title' => 'Mon premier titre'
            ]);
            $this->delete(route('admin.categories.destroy', $attributes['id']));
            $category = Categorie::count();
            $this->assertEquals(0, $category);
            $this->assertNull(Categorie::first());
        } else {
            $this->authGuardToRedirect(1);
        }
    }
}
