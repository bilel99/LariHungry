<?php

namespace App\Http\Controllers\front;

use App\Categorie;
use App\Comment;
use App\Http\Helpers\UploaderFiles;
use App\Note;
use App\Restaurant;
use App\Tag;
use App\User;
use App\UserRestaurantFav;
use App\Ville;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Mockery\Matcher\Not;

class RestaurantsController extends Controller
{
    use UploaderFiles;

    /**
     * RestaurantsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show', 'search');
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $restaurants = Restaurant::with('categories', 'tags', 'medias', 'user', 'ville')
            ->get();

        $images = [];
        foreach ($restaurants as $row) {
            if ($row->medias !== null) {
                foreach ($row->medias as $m) {
                    $item = explode('/', $m->path);
                    array_push($images, end($item));
                }
            }
            $lengthComments = Comment::where('restaurant_id', $row->id)->count();
            $note = new Note();
            $avgNotes = $note->calcAverageAllNoteByRestaurant($row->id);
        }

        $categories = Categorie::all();
        $pluckCat = $categories->pluck('title', 'id');

        return view('front.restaurant.index',
            compact('restaurants', 'images', 'pluckCat', 'lengthComments', 'avgNotes'));
    }

    /**
     * @param Restaurant $restaurant
     * @return Factory|View
     */
    public function show(Restaurant $restaurant)
    {
        $user = User
            ::with('media')
            ->where('id', Auth::user()->id)
            ->first();

        $avatar = '';
        if ($user->media !== null) {
            $tableUser = explode('/', $user->media->path);
            $avatar = end($tableUser);
        }

        $restaurant = Restaurant::with('categories', 'tags', 'medias', 'user', 'ville')
            ->where('id', $restaurant->id)
            ->first();

        $images = [];
        foreach ($restaurant->medias as $m) {
            $item = explode('/', $m->path);
            array_push($images, end($item));
        }

        $comments = Comment
            ::with('user', 'restaurant')
            ->where('restaurant_id', $restaurant->id)
            ->get();

        // Calc Average Notes By Restaurant
        $notes = new Note();
        $avgNotes = $notes->calcAverageAllNoteByRestaurant($restaurant->id);

        // Fav
        $fav = UserRestaurantFav::with('restaurant')
            ->where('restaurant_id', $restaurant->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        $rating = Note
            ::where('user_id', Auth::user()->id)
            ->where('restaurant_id', $restaurant->id)
            ->first();

        return view('front.restaurant.show',
            compact('restaurant', 'images', 'fav', 'rating', 'avgNotes', 'comments', 'avatar'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $categories = Categorie::all();
        $tag = Tag::all();
        $pluckCat = $categories->pluck('title', 'id');
        $pluckTag = $tag->pluck('tag', 'id');
        return view('front.restaurant.create', [
            'categories' => $pluckCat,
            'tag' => $pluckTag
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|min:2',
            'description' => 'required|min:10',
            'adress' => 'required',
            'restaurant.category' => '',
            'restaurant.tag' => '',
            'price' => 'required|numeric',
            'restaurant_media' => ''
            // mimes:jpeg,png,jpg|size:2048
        ]);
        if ($validation->fails()) {
            return redirect()->route('front.restaurant.create')
                ->withErrors($validation)
                ->withInput();
        }

        $ville = Ville::where('zipcode', $request->input('cp'))->limit(1)->get();
        $restaurant = new Restaurant();
        $restaurant->title = $request->input('title');
        $restaurant->description = $request->input('description');
        $restaurant->adress = $request->input('adress');
        $restaurant->user_id = Auth::user()->id;
        $restaurant->ville_id = $ville[0]->id;
        $restaurant->price = $request->input('price');
        $restaurant->save();

        // Relationship (Categories / Tag / Media)
        $categories = Categorie::where('id', $request->input('restaurant_category'))->get();
        $restaurant->categories()->attach($categories);

        // Multiple
        foreach ($request->input('restaurant_tag') as $row) {
            $tags = Tag::where('id', $row)->get();
            $restaurant->tags()->attach($tags);
        }

        // Upload files
        $name = 'restaurant_media';
        $directory = 'uploads/restaurants/';
        if ($request->file($name) !== null) {
            $this->deletedFileExist($restaurant);
            $this->addMedia($request, $restaurant, $name, $directory, false, true);
        }

        $request->session()->flash('success', 'created restaurant successfully!');
        return redirect()->route('front.restaurant.index');
    }

    /**
     * @param Restaurant $restaurant
     * @return Factory|View
     */
    public function edit(Restaurant $restaurant)
    {
        $restaurant = Restaurant
            ::with('categories', 'tags', 'medias', 'user', 'ville')
            ->where('id', $restaurant->id)
            ->first();

        $catgories = Categorie::all();
        $tag = Tag::all();

        $pluckCat = $catgories->pluck('title', 'id');
        $pluckCat->all();
        $pluckTag = $tag->pluck('tag', 'id');
        $pluckTag->all();

        return view('front.restaurant.edit',
            compact('restaurant', 'pluckCat', 'pluckTag'));
    }

    /**
     * @param Restaurant $restaurant
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Restaurant $restaurant, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:2',
            'description' => 'required|min:10',
            'adress' => 'required',
            'restaurant.category' => '',
            'restaurant.tag' => '',
            'price' => 'required|numeric',
            'restaurant_media' => ''
            // mimes:jpeg,png,jpg|size:2048
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $ville = Ville::where('zipcode', $request->input('cp'))->limit(1)->get();
        $restaurant->title = $request->input('title');
        $restaurant->description = $request->input('description');
        $restaurant->adress = $request->input('adress');
        $restaurant->user_id = Auth::user()->id;
        $restaurant->ville_id = $ville[0]->id;
        $restaurant->price = $request->input('price');
        $restaurant->save();

        // Relationship (Categories / Tag / Media)
        $categories = Categorie::where('id', $request->input('restaurant_category'))->get();
        $restaurant->categories()->sync($categories);

        // Multiple
        foreach ($request->input('restaurant_tag') as $row) {
            $tags = Tag::where('id', $row)->first();
            $restaurant->tags()->detach($tags);
            $restaurant->tags()->attach($tags);
        }

        // Upload files
        $name = 'restaurant_media';
        $directory = 'uploads/restaurants/';
        if ($request->file($name) !== null) {
            $this->deletedFileExist($restaurant);
            $this->addMedia($request, $restaurant, $name, $directory, true, true);
        }

        $request->session()->flash('success', 'Edited restaurant successfully!');
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param Restaurant $restaurant
     * @return Factory|View
     */
    public function search(Request $request, Restaurant $restaurant)
    {
        $categories = Categorie::all();
        $pluckCat = $categories->pluck('title', 'id');

        $name = $request->input('title');
        $city = $request->input('ville');
        $category = $request->input('category');
        $tag = $request->input('tag');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $search = $restaurant->search($name, $city, $category, $tag, $minPrice, $maxPrice);

        $images = [];
        $lengthComments = null;
        $avgNotes = null;
        foreach ($search as $row) {
            if ($row->medias !== null) {
                foreach ($row->medias as $m) {
                    $item = explode('/', $m->path);
                    array_push($images, end($item));
                }
            }
            $lengthComments = Comment::where('restaurant_id', $row->id)->count();
            $note = new Note();
            $avgNotes = $note->calcAverageAllNoteByRestaurant($row->id);
        }

        return view('front.restaurant.search', [
            'pluckCat' => $pluckCat,
            'restaurants' => $search,
            'images' => $images,
            'lengthComments' => $lengthComments,
            'avgNotes' => $avgNotes
        ]);
    }

    public function addMyFav(Restaurant $restaurant, Request $request)
    {
        $favorite = UserRestaurantFav::with('restaurant')
            ->where('user_id', Auth::user()->id)
            ->where('restaurant_id', $restaurant->id)
            ->first();
        if ($favorite !== null) {
            if ($favorite->fav == false) {
                $favorite->fav = true;
            } else {
                $favorite->fav = false;
            }
        } else {
            $favorite = new UserRestaurantFav();
            $favorite->user_id = Auth::user()->id;
            $favorite->restaurant_id = $restaurant->id;
            $favorite->fav = true;
        }
        $favorite->save();

        $request->session()->flash('success', 'Favorite is changed!');
        return redirect()->back();
    }

    /**
     * @param Restaurant $restaurant
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function addRating(Restaurant $restaurant, Request $request)
    {
        $notes = Note
            ::where('user_id', Auth::user()->id)
            ->where('restaurant_id', $restaurant->id)
            ->first();
        if ($notes === null) {
            $rate = new Note();
            $rate->note = Input::get('notes');
            $rate->user_id = Auth::user()->id;
            $rate->restaurant_id = $restaurant->id;
            $rate->save();
            $message = 'Well done, your notes have been recorded!';
        } else {
            $message = 'You have rated this restaurant!';
        }

        // Ajax
        if ($request->isXmlHttpRequest()) {
            $response = new JsonResponse();
            return $response->setData([
                'message' => $message
            ]);
        } else {
            throw new \Exception('Error Ajax request!');
        }
    }

    /**
     * @param Restaurant $restaurant
     * @return RedirectResponse
     */
    public function postComment(Restaurant $restaurant, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->restaurant_id = $restaurant->id;
        $comment->title = 'Comment title - ' . Auth::user()->id;
        $comment->comment = Input::get('comment');
        $comment->save();

        $request->session()->flash('success', 'successfully created comment!');
        return redirect()->back();
    }

    /**
     * @param Restaurant $restaurant
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Restaurant $restaurant, Request $request)
    {
        // Policy call method delete return true || false is authorized
        $this->authorize('delete', $restaurant);

        $restaurant->delete();
        $request->session()->flash('success', 'Restaurant is deleted!');
        return redirect()->route('front.restaurant.index');
    }

}
