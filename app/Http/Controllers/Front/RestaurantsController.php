<?php

namespace App\Http\Controllers\front;

use App\Categorie;
use App\Http\Helpers\UploaderFiles;
use App\Restaurant;
use App\Tag;
use App\Ville;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RestaurantsController extends Controller
{
    use UploaderFiles;

    public function __construct()
    {
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $restaurants = \App\Restaurant::with('categories', 'tags', 'medias', 'user', 'ville')
            ->get();

        $images = [];
        foreach ($restaurants as $row) {
            foreach ($row->medias as $m) {
                $item = explode('/', $m->path);
                array_push($images, end($item));
            }
        }

        $categories = Categorie::all();
        $tag = Tag::all();

        $pluckCat = $categories->pluck('title', 'id');
        $pluckTag = $tag->pluck('tag', 'id');

        return view('front.restaurant.index',
            compact('restaurants', 'images', 'pluckTag', 'pluckCat'));
    }

    public function show(Restaurant $restaurant)
    {
        $restaurant = \App\Restaurant::with('categories', 'tags', 'medias', 'user', 'ville')
            ->where('id', $restaurant->id)
            ->get();

        return view('front.restaurant.show',
            compact('restaurant'));
    }

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

    public function search(Request $request, Restaurant $restaurant)
    {
        $categories = Categorie::all();
        $tag = Tag::all();

        $pluckCat = $categories->pluck('title', 'id');
        $pluckTag = $tag->pluck('tag', 'id');

        $name = $request->input('title');
        $city = $request->input('ville');
        $category = $request->input('category');
        $tag = $request->input('tag');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $search = $restaurant->search($name, $city, $category, $tag, $minPrice, $maxPrice);

        $images = [];
        foreach ($search as $row) {
            $item = explode('/', $row->path);
            array_push($images, end($item));
        }

        return view('front.restaurant.search',
            compact('pluckCat', 'pluckTag', 'search', 'images'));
    }

}
