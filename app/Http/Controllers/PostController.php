<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index' , ['posts' => Post::all()]) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        return view('posts.edit' , ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // authentication

        // autherization

        // validate

        $attributes = $request->validate([
            'topic' => ['required'],
            'description' => ['required']
        ]) ;

        // update
            $post->update($attributes) ;
        // scesion

        // redirect

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
