<?php

namespace App\Http\Controllers\Front;

use App\UserRestaurantFav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $fav = UserRestaurantFav
            ::with('user', 'restaurant')
            ->where('fav', true)
            ->get();

        return view('front.user.my-favorite', compact('fav'));
    }

    public function destroy(UserRestaurantFav $fav)
    {
        if ($fav->user_id === Auth::user()->id) {
            $fav->delete();
            return redirect()->back();
        }
    }
}
