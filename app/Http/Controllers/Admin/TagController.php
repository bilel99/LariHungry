<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class TagController extends Controller
{

    /**
     * @return Factory|View
     */
    public function index()
    {
        $tag = Tag::all();
        return view('admin.tag.index', [
            'tag' => $tag
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tag' => 'required|min:2'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.tag.create')
                ->withErrors($validator)
                ->withInput();
        }
        $tag = new Tag();
        $input = $request->all();
        $tag->fill($input)->save();
        $request->session()->flash('success', 'created successfull!');
        return redirect()->route('admin.tag.index');
    }

    /**
     * @param Tag $tag
     * @return Factory|View
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', [
            'tag' => $tag
        ]);
    }

    /**
     * @param Tag $tag
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Tag $tag, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tag' => 'required|min:2'
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.tag.edit', $tag->id)
                ->withErrors($validator)
                ->withInput();
        }
        $input = $request->all();
        $tag->fill($input)->save();
        $request->session()->flash('success', 'edition successfully!');
        return redirect()->route('admin.tag.edit', $tag->id);
    }

    /**
     * @param Tag $tag
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Tag $tag, Request $request)
    {
        $tag->delete();
        $request->session()->flash('success', 'deleted successfull!');
        return redirect()->route('admin.tag.index');
    }
}
