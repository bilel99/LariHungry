<?php

namespace App\Http\Controllers\front;

use App\Categorie;
use App\Media;
use App\Restaurant;
use App\Tag;
use App\Ville;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RestaurantsController extends Controller
{


    public function __construct()
    {
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
     * @param Restaurant $restaurant
     */
    public function deletedFileExist(Restaurant $restaurant)
    {
        // Deleted files exists
        $media = Media::with('restaurants')->get();
        foreach ($media as $m) {
            foreach ($m->restaurants as $r) {
                if ($r->id === $restaurant->id) {
                    // deleted file
                    if (file_exists($m->path)) {
                        unlink($m->path);
                    }
                }
            }
        }
    }

    public function store(Request $request){
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
            return redirect()->route('restaurant.create')
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
            $this->addMedia($request, $restaurant, $name, $directory,false, true);
        }

        $request->session()->flash('success', 'created restaurant successfully!');
        return redirect()->route('restaurant.index');
    }

}
