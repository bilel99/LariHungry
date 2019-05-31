<?php

namespace App\Http\Controllers\Front;

use App\Contact;
use App\Faq;
use App\Newsletters;
use App\Restaurant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class HomeController extends Controller
{

    /**
     * @return Factory|View
     */
    public function index()
    {
        $restaurants = Restaurant::with('categories', 'tags', 'medias', 'user', 'ville')->limit(10)->get();

        $images = [];
        foreach ($restaurants as $row) {
            foreach ($row->medias as $m) {
                $item = explode('/', $m->path);
                array_push($images, end($item));
            }
        }
        return view('front.home.index', compact('restaurants', 'images'));
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function contact(Request $request)
    {
        $faq = Faq::all();
        return view('front.home.contact', [
            'faq' => $faq
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function createContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:255',
            'firstname' => 'required|min:5|max:255',
            'email' => 'required|min:5|max:255|email',
            'sujet' => 'required|min:5|max:255',
            'number_phone' => 'min:10|numeric',
            'restaurant' => '',
            'text' => 'required|min:5|max:255'
        ]);
        if ($validator->fails()) {
            return redirect()->route('front.contact')
                ->withErrors($validator)
                ->withInput();
        }

        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->firstname = $request->input('firstname');
        $contact->email = $request->input('email');
        $contact->sujet = $request->input('sujet');
        $contact->number_phone = $request->input('number_phone');
        $contact->restaurant = $request->input('restaurant');
        $contact->text = $request->input('text');
        $contact->done = 0;
        $contact->save();
        $request->session()->flash('success', 'created successfuly the contact request!');
        return redirect()->route('front.contact');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function createFaq(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|min:8'
        ]);
        if ($validator->fails()) {
            return redirect()->route('front.contact')
                ->withErrors($validator)
                ->withInput();
        }

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = 'Waiting for Answer!';
        $faq->done = 0;
        $faq->save();
        $request->session()->flash('success', 'created Question successfully!');
        return redirect()->route('front.contact');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function createNewsletter(Request $request)
    {
        $newsletter = new Newsletters();
        $newsletter->email = $request->input('newsletter');
        $newsletter->status = 0;
        $newsletter->save();
        $request->session()->flash('success', 'Your email is register successfully!');
        return redirect()->back();
    }

}
