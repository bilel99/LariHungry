<?php

namespace App\Http\Controllers\Front;

use App\Http\Helpers\UploaderFiles;
use App\Media;
use App\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use UploaderFiles;

    public function index()
    {
        return view('front.user.index');
    }

    /**
     * @param User $user
     */
    public function deletedFileExist(User $user)
    {
        // Deleted files exists
        $media = Media::get();
        foreach ($media as $m) {
            if ($m->id === $user->id) {
                // deleted file
                if (file_exists($m->path)) {
                    unlink($m->path);
                }
            }
        }
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:255',
            'firstname' => 'required|min:4|max:255',
            'email' => 'required|min:7|max:255|email',
            'media' => ''
            //mimes:jpeg,png,jpg|size:2048
        ]);
        if ($validator->fails()) {
            return redirect()->route('front.profil', Auth::user()->id)
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->input('name');
        $user->firstname = $request->input('firstname');
        $user->email = $request->input('email');
        // Media
        $name = 'media';
        $directory = 'uploads/user/';
        $update = false;
        if (Auth::user()->media_id === null) {
            $update = false;
        } else {
            $update = true;
        }
        if ($request->file($name) !== null) {
            $this->deletedFileExist($user);
            $this->addMedia($request, null, $name, $directory, $update, false);
        }

        $user->save();
        $request->session()->flash('success', 'updated user successfully!');
        return redirect()->route('front.profil', Auth::user()->id);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPassword()
    {
        return view('front.user.edit-password');
    }

    /**
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     */
    public function updatePassword(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:5|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->route('front.edit.password', Auth::user()->id)
                ->withErrors($validator)
                ->withInput();
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();
        $request->session()->flash('success', 'updated password successfully');
        return redirect()->route('front.profil', Auth::user()->id);
    }

    /**
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user, Request $request)
    {
        $this->deleteMedia(null, false);
        $user->delete();
        $request->session()->flash('success', 'Deleted successfully');
        return redirect()->route('logout');
    }

}
