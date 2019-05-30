<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ContactController extends Controller
{

    /**
     * @return Factory|View
     */
    public function index()
    {
        $contact = Contact::get();
        return view('admin.contact.index', [
            'contact' => $contact
        ]);
    }

    /**
     * @param Contact $contact
     * @return Factory|View
     */
    public function show(Contact $contact)
    {
        return view('admin.contact.show', [
            'contact' => $contact
        ]);
    }

    /**
     * @param Contact $contact
     * @param Request $request
     * @return RedirectResponse
     */
    public function changeStatus(Contact $contact, Request $request)
    {
        if ($contact->done === 1) {
            $contact->done = 0;
        } else {
            $contact->done = 1;
        }
        $contact->save();
        $request->session()->flash('success', 'Successfull!');
        return redirect()->route('admin.contact');
    }

    /**
     * @param Contact $contact
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Contact $contact, Request $request)
    {
        $contact->delete();
        $request->session()->flash('warning', 'Successfull deleted!');
        return redirect()->route('admin.contact');
    }
}
