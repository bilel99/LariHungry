<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Newsletters;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{

    /**
     * @return Factory|View
     */
    public function index()
    {
        $nbr_user = User::where('is_active', '=', '1')->count();
        $nb_contact = Contact::count();
        return view('admin.dashboard.index', [
            'nbr_user' => $nbr_user,
            'nbr_contact' => $nb_contact
        ]);
    }

    /**
     * @return Factory|View
     */
    public function newsletters()
    {
        $newsletters = Newsletters::all();
        return view('admin.newsletters.index', compact(
            'newsletters'
        ));
    }

    /**
     * @param Newsletters $newsletters
     * @param Request $request
     * @return RedirectResponse
     */
    public function changeStatusNewsletter(Newsletters $newsletters, Request $request)
    {
        if ($newsletters->status === 0) {
            $newsletters->status = 1;
        } else {
            $newsletters->status = 0;
        }
        $newsletters->save();
        $request->session()->flash('success', 'Status is changed!');
        return redirect()->route('admin.newsletters');
    }

    /**
     * @param Newsletters $newsletters
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function deleteNewsletter(Newsletters $newsletters, Request $request)
    {
        $newsletters->delete();
        $request->session()->flash('success', 'Success deleted!');
        return redirect()->route('admin.newsletters');
    }

}
