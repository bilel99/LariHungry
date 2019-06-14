<?php

namespace App\Http\Controllers\Front;

use App\UserRestaurantFav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    /**
     * FavoriteController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        // Policy call method delete return true || false is authorized
        $this->authorize('delete', $fav);

        $fav->delete();
        return redirect()->back();
    }
}
