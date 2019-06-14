<?php

namespace App\Http\Controllers\Admin;

use App\Categorie;
use App\Http\Helpers\UploaderFiles;
use App\Tag;
use App\Restaurant;
use App\Ville;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RestaurantsController extends Controller
{
    use UploaderFiles;

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
        $restaurants = Restaurant::all();
        return view('admin.restaurant.index', [
            'restaurants' => $restaurants
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Categorie::all();
        $tag = Tag::all();
        $pluckCat = $categories->pluck('title', 'id');
        $pluckTag = $tag->pluck('tag', 'id');
        return view('admin.restaurant.create', [
            'categories' => $pluckCat,
            'tag' => $pluckTag
        ]);
    }

    /**
     * @param int $cp
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function getVille(int $cp, Request $request)
    {
        $ville = Ville::where('zipcode', $cp)->limit(1)->get();
        if ($ville) {
            // Ajax
            if ($request->isXmlHttpRequest()) {
                $response = new JsonResponse();
                return $response->setData([
                    'ville' => $ville[0]->libelle
                ]);
            }
        } else {
            throw new \Exception('Error request Ajax');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
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
            return redirect()->route('admin.restaurant.create')
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
        return redirect()->route('admin.restaurant.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Restaurant $restaurant
     * @return Response
     */
    public function show(Restaurant $restaurant)
    {
        return view('admin.restaurant.show', [
            'restaurant' => $restaurant
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Restaurant $restaurant
     * @return void
     */
    public function edit(Restaurant $restaurant)
    {
        $restaurant = Restaurant::with('categories', 'tags', 'user', 'ville')->where('id', $restaurant->id)->first();

        $categories = Categorie::all();
        $tag = Tag::all();

        $pluckCat = $categories->pluck('title', 'id');
        $pluckTag = $tag->pluck('tag', 'id');

        return view('admin.restaurant.edit', [
            'restaurant' => $restaurant,
            'categories' => $pluckCat,
            'tag' => $pluckTag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Restaurant $restaurant
     * @return void
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:2',
            'description' => 'required|min:10',
            'adress' => 'required',
            'restaurant.category' => '',
            'restaurant.tag' => '',
            'price' => 'required|numeric',
            'restaurant_media' => ''
            //mimes:jpeg,png,jpg|size:2048
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.restaurant.edit', $restaurant->id)
                ->withErrors($validator)
                ->withInput();
        }

        $ville = Ville::where('zipcode', $request->input('cp'))->limit(1)->get();
        $restaurant->title = $request->input('title');
        $restaurant->description = $request->input('description');
        $restaurant->adress = $request->input('adress');
        $restaurant->ville_id = $ville[0]->id;
        $restaurant->price = $request->input('price');
        $restaurant->save();

        // Relationship (Categories / Tag / Media)
        $categories = Categorie::where('id', $request->input('restaurant_category'))->get();
        $restaurant->categories()->sync($categories);

        // Multiple
        foreach ($request->input('restaurant_tag') as $row) {
            $tags = Tag::where('id', $row)->get();
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

        $request->session()->flash('success', 'Edition restaurant successfully!');
        return redirect()->route('admin.restaurant.edit', $restaurant->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Restaurant $restaurant
     * @param Request $request
     * @return void
     * @throws \Exception
     */
    public function destroy(Restaurant $restaurant, Request $request)
    {
        // Deleted Media and relationship and files
        $this->deleteMedia($restaurant, true);
        $restaurant->delete();
        $request->session()->flash('success', 'restaurant deleted successfull!');
        return redirect()->route('admin.restaurant.index');
    }
}
