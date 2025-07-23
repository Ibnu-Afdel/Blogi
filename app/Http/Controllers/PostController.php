<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('user')->latest()->simplePaginate(5);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
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
            // $attributes['image'] = '/storage/' . $imagePath;
            $attributes['image'] = $imagePath;
        } else {
            $attributes['image'] = null;
        }

        $attributes['user_id'] = Auth::id();

        Post::create($attributes);

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {

        $post->load('comments.user');


        return view('posts.show', compact('post'));
    }


    public function edit(Post $post)
    {

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {

        $attributes = $request->validate([
            'topic' => ['required'],
            'description' => ['required'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                // Storage::disk('public')->delete(str_replace('/storage/', '', $post->image));
                Storage::disk('public')->delete($post->image); // now the storage will be appended in blade..
            }
            // Stores new image
            $imagepath = $request->file('image')->store('images', 'public');
            // $attributes['image'] = '/storage/' . $imagepath;
            $attributes['image'] =  $imagepath;
        }

        $post->update($attributes);

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();
        return redirect()->route('posts.index');
    }
}
