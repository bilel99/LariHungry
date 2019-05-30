<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\View\Factory;
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

}