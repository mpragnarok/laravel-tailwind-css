<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['body' => 'required']);


        // => is the assign operator that is used while creating an array.
        // -> is the access operator. It accesses an object's value
        // create functionality
//        $request->user()->posts()->create(['body' => $request->body]);
        $request->user()->posts()->create($request->only('body'));
        return back();
    }
}
