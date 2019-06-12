<?php

namespace App\Http\Controllers\Front;

use App\Comment;
use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment
            ::with('user', 'restaurant')
            ->where('user_id', Auth::user()->id)
            ->get();

        return view('front.user.my-comments', compact('comments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Comment $comment
     * @return void
     */
    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id == Auth::user()->id) {
            $validator = Validator::make($request->all(), [
                'comment' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $comment->comment = Input::get('comment');
            $comment->save();
            $request->session()->flash('success', 'Your comment is update!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @param Request $request
     * @return void
     * @throws \Exception
     */
    public function destroy(Comment $comment, Request $request)
    {
        if ($comment->user_id == Auth::user()->id) {
            $comment->delete();
            $request->session()->flash('success', 'Comment deleted!');
            return redirect()->back();
        }
    }
}
