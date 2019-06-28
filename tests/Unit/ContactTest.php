<?php

namespace Tests\Unit;

use App\Contact;
use App\Faq;
use App\Newsletters;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group contact-page
     * @test
     *
     * @return void
     */
    public function testItIndexContactPage()
    {
        $response = $this->get(route('front.contact'));
        $response->assertStatus(200);
        $response->assertSuccessful();
    }

    /**
     * @group valid-create-contact
     * @test
     *
     * @return void
     */
    public function testItStoreAValidCreateContact()
    {
        $attributes = factory(Contact::class)->raw();
        $response = $this->post('/create-contact', $attributes);
        $contact = Contact::count();
        $this->assertEquals(1, $contact);
        $response->assertRedirect(route('front.contact'));
    }

    /**
     * @group not-valid-create-contact
     * @test
     *
     * @return void
     */
    public function testItStoreANotValidCreateContact()
    {
        $response = $this->post('/create-contact', []);
        $response->assertSessionHasErrors();
        $this->assertNull(Contact::first());
    }


    /**
     * @group valid-create-faq
     * @test
     *
     * @return void
     */
    public function testItStoreAValidCreateFaq()
    {
        $attributes = factory(Faq::class)->raw();
        $response = $this->post('/create-faq', $attributes);
        $faq = Faq::count();
        $this->assertEquals(1, $faq);
        $response->assertRedirect(route('front.contact'));
    }

    /**
     * @group not-valid-create-faq
     * @test
     *
     * @return void
     */
    public function testItStoreANotValidCreateFaq()
    {
        $response = $this->post('/create-faq', []);
        $response->assertSessionHasErrors();
        $this->assertNull(Faq::first());
    }

    /**
     * @group valid-create-newsletter
     * @test
     *
     * @return void
     */
    public function testItStoreAValidCreateNewsletter()
    {
        $attributes = factory(Newsletters::class)->raw();
        $this->post('/create-newsletter', $attributes);
        $newsletter = Newsletters::count();
        $this->assertEquals(1, $newsletter);

        // Testing $this->redirect()->back()
        $this->call('POST', '/contact', ['input' => ''], [], [], ['HTTP_REFERER' => '/contact']);
    }

    /**
     * @group not-valid-create-newsletter
     * @test
     *
     * @return void
     */
    public function testItStoreANotValidCreateNewsletter()
    {
        $response = $this->post('/create-newsletter', []);
        $response->assertSessionHasErrors();
        $this->assertNull(Newsletters::first());
    }

}
