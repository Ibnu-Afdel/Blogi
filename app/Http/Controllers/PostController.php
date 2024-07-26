<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at' , 'desc')->get();
        return view('posts.index' , ['posts' => $posts ]) ;
    }

    public function create()
    {
        return view('posts.create') ;
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'topic' => ['required'],
            'description' => ['required'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $attributes['image'] = '/storage/' . $imagePath;
        } else {
            $attributes['image'] = null;
        }
    
        $attributes['user_id'] = Auth::id();
        
        Post::create($attributes);
    
        return redirect()->route('posts.index');
    }
    
    public function show(Post $post)
    {
        return view('posts.show' , ['post' => $post]) ;
    }


    public function edit(Post $post)
    {
        if (Auth::guest()){
            return redirect()->route('login.create') ;
        }
        return view('posts.edit' , ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {

        $attributes = $request->validate([
            'topic' => ['required'],
            'description' => ['required']
        ]) ;

            $post->update($attributes) ;

        return redirect()->route('posts.show', $post) ;

    }

    public function destroy(Post $post)
    {
        $post->delete() ;
        return redirect()->route('posts.index');
    }
}
