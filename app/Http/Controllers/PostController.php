<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // eager loading to save query
        // latest() is equal to orderBy('created_at','desc')
        $posts = Post::latest()->with(['user', 'likes'])->paginate(20);
        return view('posts.index', [
            'posts' => $posts
        ]);
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

    public function destroy(Post $post)
    {
        // with PostPolicy, we can authorize user action
        $this->authorize('delete',$post); // will throw out 403 forbidden
        $post->delete();
        return back();
    }
}
