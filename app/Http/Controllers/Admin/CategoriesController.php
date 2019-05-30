<?php

namespace App\Http\Controllers\Admin;

use App\Categorie;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CategoriesController extends Controller
{

    /**
     * @return Factory|View
     */
    public function index()
    {
        $categories = Categorie::all();
        return view('admin.categorie.index', [
            'categories' => $categories
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.categorie.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:2'
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.categories.create')
                ->withErrors($validator)
                ->withInput();
        }
        $category = new Categorie();
        $input = $request->all();
        $category->fill($input)->save();
        $request->session()->flash('success', 'created successfull!');
        return redirect()->route('admin.categories.index');
    }

    /**
     * @param Categorie $category
     * @return Factory|View
     */
    public function edit(Categorie $category)
    {
        return view('admin.categorie.edit', [
            'category' => $category
        ]);
    }

    /**
     * @param Categorie $category
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Categorie $category, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:2'
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.categories.edit', $category->id)
                ->withErrors($validator)
                ->withInput();
        }
        $input = $request->all();
        $category->fill($input)->save();
        $request->session()->flash('success', 'Edit successfull!');
        return redirect()->route('admin.categories.edit', $category->id);
    }

    /**
     * @param Categorie $category
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Categorie $category, Request $request)
    {
        $category->delete();
        $request->session()->flash('success', 'successfull deleted!');
        return redirect()->route('admin.categories.index');
    }
}
