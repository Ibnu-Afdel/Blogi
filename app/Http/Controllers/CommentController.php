<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request, Post $post)
    {
        $attributes = $request->validate([
            'content' => ['required'],
        ]);

        $post->comments()->create([
            'content' => $attributes['content'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('posts.show', $post);
    }


    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {

        $attributes = $request->validate([
            'content' => ['required'],
        ]);

        $comment->update($attributes);

        return redirect()->route('posts.show', $comment->post);
    }

    public function destroy(comment $comment)
    {
        $comment->delete();

        return back();
    }
}
