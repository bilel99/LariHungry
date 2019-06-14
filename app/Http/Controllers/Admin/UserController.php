<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $user = User::get();
        return view('admin.user.index', [
            'user' => $user
        ]);
    }

    /**
     * @param User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
        return view('admin.user.show', [
            'user' => $user
        ]);
    }

    /**
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function changeStatus(User $user, Request $request)
    {
        if ($user->is_active === 1) {
            $user->is_active = 0;
        } else {
            $user->is_active = 1;
        }
        $user->save();
        $request->session()->flash('success', 'successfull change status!');
        return redirect()->route('admin.user.show', $user->id);
    }

    /**
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function changeOwner(User $user, Request $request)
    {
        if ($user->getRole() === 'ROLE_ADMIN') {
            $user->roles = serialize($user::ROLE_USER);
        } else {
            $user->roles = serialize($user::ROLE_ADMIN);
        }
        $user->save();
        $request->session()->flash('success', 'successful!');
        return redirect()->route('admin.user');
    }

    /**
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user, Request $request)
    {
        $user->delete();
        $request->session()->flash('warning', 'successfull deleted!');
        return redirect()->route('admin.user');
    }
}
