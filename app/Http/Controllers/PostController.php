<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->get();
        return view('posts.index' , ['posts' => $posts]) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::guest()){
            return redirect()->route('login.create') ;
        }
        return view('posts.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $attributes = $request->validate([
            'topic' => ['required'],
            'description' => ['required']
        ]) ;

    
        $attributes['user_id'] = Auth::id() ;
        
        // create
        Post::create($attributes) ;
        // redirect
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show' , ['post' => $post]) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::guest()){
            return redirect()->route('login.create') ;
        }
        return view('posts.edit' , ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $attributes = $request->validate([
            'topic' => ['required'],
            'description' => ['required']
        ]) ;

        // update
            $post->update($attributes) ;

        return redirect()->route('posts.index') ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete() ;
        return redirect()->route('posts.index');
    }
}
